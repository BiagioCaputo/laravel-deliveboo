<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeToken(Request $request, Gateway $gateway)
    {
        // Recupero il token generato
        $token = $gateway->clientToken()->generate();

        // $nonce = $gateway->paymentMethodNonce()->create($request->input('paymentMethodToken'));
        // 'paymentMethodNonce' => $nonce->nonce
        // Mando al client il token e il
        return response()->json($token, 200);
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        // Valido i dati nella request
        $request->validate(
            [
                'customer_name' => 'required|string|min:3',
                'customer_address' => 'required|string',
                'customer_email' => 'required|email',
                'customer_phone_number' => 'required|min:10|max:10',
                'dishes' => 'required|array',
                'restaurant_id' => 'required|string|min:1',
                'payment_method_nonce' => 'required',
                'card_number' => 'required|string|digits:16',
                'card_expire_date' => 'required|string'
            ],
            [
                'customer_name.required' => 'Campo obbligatorio',
                'customer_name.min' => 'Il nome deve avere almeno :min caratteri',
                'customer_address.required' => 'Campo obbligatorio',
                'customer_email.required' => 'Campo obbligatorio',
                'customer_email.email' => 'Inserire una mail valida',
                'customer_phone_number.required' => 'Campo obbligatorio',
                'customer_phone_number.min' => 'Il numero avere :min cifre',
                'customer_phone_number.max' => 'Il numero avere :max cifre',
                'card_number.required' => 'Campo obbligatorio',
                'card_number.digits' => 'Il numero carta deve essere di :digits cifre',
                'card_expire_date.required' => 'Campo obbligatorio',
            ]
        );

        // card_number: '',
        // card_expire_date: '',
        // cvv_code: '',

        // Se in request non ho dati
        if (!$request->input('customer_name') && !$request->input('customer_address') && !$request->input('customer_email') && !$request->input('customer_phone_number')) {
            // Restituisci un messaggio di errore
            $data = [
                'success' => false,
                'message' => 'Transazione fallita'
            ];
            return response()->json($data, 401);
        }

        // Altrimenti
        else {
            // Attribuisco forzatamente il token per il metodo di pagamento
            $nonceFromTheClient = $request->input('payment_method_nonce', 'fake-valid-nonce');

            // Recupero i piatti selezionati dall'utente e il relativo ristorante
            $dishes = $request->input('dishes');
            $restaurant = $request->input('restaurant_id');

            // Variabile per stabilire il prezzo totale
            $amount = 0;

            // Per ogni piatto nella request
            foreach ($dishes as $dish) {
                // Recuperiamo l'id e la quantità del piatto
                $id = $dish['id'];
                $quantity = $dish['quantity'];
                // Recuperiamo l'id del ristorante
                $restaurant_id = $restaurant;
                // Verifichiamo che ci sia effettivamente un piatto con l'id che ci arriva per quel ristorante
                $dish_price = Dish::where('restaurant_id', $restaurant_id)->where('id', $id)->value('price');
                // Se è settato un prezzo per quel piatto
                if ($dish_price) {
                    // Calcolo il prezzo del piatto
                    $amount += (float) $dish_price * $quantity;
                }
            }

            // Conversione in decimale del risultato
            $amount = number_format($amount, 2);

            // Creo la transazione
            // TODO - Integrare con il prezzo totale
            $transaction = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonceFromTheClient,
                'customer' => [
                    'firstName' => $request->input('customer_name'),
                    'email' => $request->input('customer_email'),
                    'phone' => $request->input('customer_phone_number'),
                ],
                'shipping' => [
                    'firstName' => $request->input('customer_name'),
                    'streetAddress' => $request->input('customer_address')
                ],
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            // Se la transazione va a buon fine
            if ($transaction->success) {

                // Creo un nuovo ordine
                $order = new Order([
                    'restaurant_id' => $restaurant,
                    'customer_name' => $request->input('customer_name'),
                    'customer_address' => $request->input('customer_address'),
                    'customer_email' => $request->input('customer_email'),
                    'customer_phone' => $request->input('customer_phone_number'),
                    'total_price' => $amount,
                    'status' => 1,
                ]);

                // Salvo l'ordine
                $order->save();

                $data = [
                    'success' => true,
                    'message' => 'Transazione eseguita con successo'
                ];
                return response()->json($data, 200);
            }
            // Se la transazione non va a buon fine
            else {
                $data = [
                    'success' => false,
                    'message' => 'Transazione fallita'
                ];
                return response()->json($data, 401);
            }
        }
    }
}

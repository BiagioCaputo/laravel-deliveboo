<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
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
        // var_dump($request->input());
        // dd($request->input('amount'));
        // dd($request->getContent());
        $nonceFromTheClient = $request->input('payment_method_nonce');

        // Creo la transazione
        // TODO - Integrare con il prezzo totale
        $transaction = $gateway->transaction()->sale([
            'amount' => '10.00',
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
            // 'paymentDetails' => [
            //     'customer_name' => $request->input('customer_name', 'Gianluca'),
            //     'customer_address' => $request->input('customer_address'),
            //     'customer_email' => $request->input('customer_email'),
            //     'customer_phone_number' => $request->input('customer_phone_number'),
            //     'dishes' => $request->input('dishes'),
            //     'restaurant_id' => $request->input('restaurant_id')
            // ],
            'options' => [
                // 'submitForSettlement' => True
            ]
        ]);
        // dd($transaction);

        // Restituzione della risposta
        if ($transaction->success) {
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con successo'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Transazione fallita'
            ];
            return response()->json($data, 401);
        }
    }
}

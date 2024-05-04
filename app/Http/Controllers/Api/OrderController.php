<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeToken(Request $request, Gateway $gateway)
    {
        // Recupero il token generato
        $token = $gateway->clientToken()->generate();

        // Mando al client il token
        return response()->json($token, 200);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway)
    {
        $nonceFromTheClient = $request->input('payment_method_nonce');
        // Creo la transazione
        // TODO - Integrare con il prezzo totale
        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonceFromTheClient,
            'deviceData' => $request,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        // Restituzione della risposta con i dati della transazione
        if ($result->success) {
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
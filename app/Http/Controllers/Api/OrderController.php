<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeToken(Request $request, Gateway $gateway)
    {
        // Recupero il token generato
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];

        // Mando al client il token
        return response()->json($data, 200);
    }

    public function makePayment(Request $request, Gateway $gateway)
    {
        // Creo la transazione
        // TODO - Integrare con i dati utili per individuare i prodotti e le quuantità per calcolare il prezzo
        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

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
        return 'make payment';
    }
}
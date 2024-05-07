<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class MailController extends Controller
{
    public function message(Request $request)
    {
        // Prendo i dati dalla request
        $data = $request->all();

        // Validazione

        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email',
                'customer_address' => 'required|string',
                'customer_name' => 'required|string',
                'final_price' => 'required|decimal:2|min:0'
            ],
            [
                'email.required' => 'Mail richiesta',
                'email.email' => 'Mail non valida',

            ]
        );

        //Manipolo l'oggetto errors che mi arriva come risposta se c'è qualche errore dopo la validazione, per avere più facilità nel mettere i dati a front 
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->messages() as $field => $messages) {
                $errors[$field] = $messages[0];
            };

            return response()->json(compact('errors'), 422); //422 = unprocessable entity
        }

        // Istanzo la mail
        $mail = new ConfirmMessageMail($data['email'], $data['customer_address'], $data['customer_name'], $data['final_price']);

        // Mando la mail
        Mail::to($data['email'])->send($mail);

        return View::make('mails.confirm_payment.message');
    }
}

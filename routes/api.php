<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\RestaurantTypeController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/restaurants', RestaurantController::class)->only('index', 'show'); //RISORSE API per i ristoranti
Route::get('/types', TypeController::class); //chiamata Api per avere le tipologie del nostro sito

//* Creo la rotta per i ristoranti raggruppati per tipologia
Route::get('types/restaurants/', RestaurantTypeController::class);

//* Creo la rotta per la generazione del token
Route::get('order/generate', [OrderController::class, 'makeToken']);

//* Creo la rotta per il pagamento
Route::post('order/payment', [OrderController::class, 'makePayment']);
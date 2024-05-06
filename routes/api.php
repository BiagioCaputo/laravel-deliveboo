<?php


use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PopularRestaurantsController;
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

//* Rotta per ristoranti e per i relativi menù
Route::apiResource('/restaurants', RestaurantController::class)->only('index', 'show');

//* Rotta per le tipologie dei ristoranti
Route::get('/types', TypeController::class);

//* Rotta per ristoranti raggruppati per tipologie
Route::get('types/restaurants/', RestaurantTypeController::class);


//* Creo la rotta per la generazione del token
Route::get('order/generate', [OrderController::class, 'makeToken']);

//* Creo la rotta per il pagamento
Route::post('order/payment', [OrderController::class, 'makePayment']);

//* Rotta per i ristoranti e le relative categorie con più ordini
Route::get('/popular-restaurants', [PopularRestaurantsController::class, 'index']);


<?php

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\RestaurantTypeController;
use App\Models\Restaurant;
use Illuminate\Http\Request;
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
Route::get('restaurant-type/{type}/restaurants', RestaurantTypeController::class); //Chiamata API per il filtro 

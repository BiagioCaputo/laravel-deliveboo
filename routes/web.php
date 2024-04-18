<?php

use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {

    //ROTTE RISTORANTE
    Route::get('/', [RestaurantController::class, 'index'])->name('home'); //Rotta in sui sarà indirizzato l'utente al login
    Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::get('/restaurant/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit');
    Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store');
    Route::put('/restaurant/update', [RestaurantController::class, 'update'])->name('restaurant.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

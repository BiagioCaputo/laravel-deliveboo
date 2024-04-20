<?php

use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
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
    Route::put('/restaurant/{restaurant}', [RestaurantController::class, 'update'])->name('restaurant.update');

    // ROTTE PER RIPRISTINO ED ELIMINAZIONE MASSIVE
    Route::delete('/dishes/massive-drop', [DishController::class, 'massiveDrop'])->name('dishes.massive-drop');
    Route::patch('/dishes/massive-restore', [DishController::class, 'massiveRestore'])->name('dishes.massive-restore');

    // ROTTE SOFT DELETE
    Route::get('/dishes/trash', [DishController::class, 'trash'])->name('dishes.trash');
    Route::patch('/dishes/{dish}/restore', [DishController::class, 'restore'])->name('dishes.restore')->withTrashed();
    Route::delete('/dishes/{dish}/drop', [DishController::class, 'drop'])->name('dishes.drop')->withTrashed();


    // ROTTE PIATTI
    Route::resource('dishes', DishController::class)->withTrashed(['show', 'edit', 'update']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
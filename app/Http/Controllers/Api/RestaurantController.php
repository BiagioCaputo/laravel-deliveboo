<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::with('user')->orderBy('activity_name')->get()/* paginate(9) */; /* mettere paginate al posto di get */

        return response()->json($restaurants);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        if (Dish::whereRestaurant_id($id)->get() == '[]') return response(null, 404);

        // Cerco le tipologie del ristorante
        $restaurant = Restaurant::with('types')->find($id);

        // Cerco i piatti con l'id del ristorante
        $dishes = Dish::whereRestaurant_id($id)->whereAvailable(true)->with('course')->orderBy('name')->get();

        // Recupera le portate solo dei piatti presenti nella show del ristorante
        $courses = $dishes->pluck('course')->unique()->values()->all();

        return response()->json(['dishes' => $dishes, 'restaurant' => $restaurant, 'courses' => $courses]);
    }
}

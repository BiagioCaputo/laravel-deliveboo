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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        if (Dish::whereRestaurant_id($id)->get() == '[]') return response(null, 404);

        $restaurant = Restaurant::with('types')->find($id);

        $dishes = Dish::whereRestaurant_id($id)->whereAvailable(true)->with('course')->orderBy('name')->get(); //cerco i piatti con l'id del ristorante

        return response()->json(['dishes' => $dishes, 'restaurant' => $restaurant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}

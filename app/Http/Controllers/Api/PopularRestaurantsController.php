<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Types;
use App\Models\Orders;

use Illuminate\Http\Request;

class PopularRestaurantsController extends Controller
{
    public function index()
    {
        // Recupera i 8 ristoranti con più ordini
        $popularRestaurants = Restaurant::with('types')->withCount('orders')->orderByDesc('orders_count')->take(8)->get();

        // Estrai le tipologie uniche dai ristoranti popolari
        $popularTypes = [];

        foreach ($popularRestaurants as $restaurant) {
            foreach ($restaurant->types as $type) {
                // Controlla se il tipo è già stato aggiunto
                if (!in_array($type->id, $popularTypes)) {
                    // Aggiungi l'ID del tipo alla lista
                    $popularTypes[] = [
                        'id' => $type->id,
                        'label' => $type->label,
                    ];
                }
            }
        }

        return response()->json([
            'popularRestaurants' => $popularRestaurants,
            'popularTypes' => $popularTypes
        ]);
    }
}

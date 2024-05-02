<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantTypeController extends Controller
{
    public function __invoke(Request $request)
    {

        // Ottieni il parametro di filtro dalla query string
        $typeIds = $request->query('type_id', []);

        // Costruisci la query per recuperare i prodotti
        $query = Restaurant::query();

        $query->whereHas('types', function ($q) use ($typeIds) {
            $q->whereIn('types.id', $typeIds);
        });

        // Esegui la query e restituisci i risultati
        $prodotti = $query->get();

        return response()->json($prodotti);
    }
}

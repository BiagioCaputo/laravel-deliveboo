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

        // Costruisci la query per recuperare i ristoranti
        $query = Restaurant::query();


        // Filtra i ristoranti in base alle tipologie
        foreach ($typeIds as $typeId)
            $query->whereHas('types', function ($q) use ($typeId) {
                $q->where('types.id', $typeId);
            });

        // Esegui la query e restituisci i risultati
        $restaurants = $query->get()/* paginate(9) */; /* mettere paginate al posto di get */

        return response()->json($restaurants);
    }
}

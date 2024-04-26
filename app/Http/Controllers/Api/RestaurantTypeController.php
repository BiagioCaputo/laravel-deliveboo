<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantTypeController extends Controller
{
    public function __invoke(string $id)
    {
        //faccio il controllo sull'esistenza di type
        $type = Type::find($id);
        if (!$type) return response(null, 404);

        //relazione molti a molti 
        $restaurant = Restaurant::whereHas('types', function ($query) use ($type) {
            $query->where('types.id', $type->id);
        })->with('user')->get();

        //restuisco tutti i ristoranti (se ci sono) e il nome della tipologia
        return response()->json(['restairants' => $restaurant, 'label' => $type->label]);
    }
}

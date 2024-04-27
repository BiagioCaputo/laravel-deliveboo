<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __invoke()
    {
        //relazione molti a molti 
        $types = Type::all();

        //restuisco tutti i ristoranti (se ci sono) e il nome della tipologia
        return response()->json($types);
    }
}

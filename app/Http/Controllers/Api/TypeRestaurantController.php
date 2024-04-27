<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeRestaurantController extends Controller
{
    public function __invoke(string $id)
    {
        $type = Type::find($id);

        if (!$type) return response(null, 404);

        $restaurants = Restaurant::whereHas('types', function ($query) use ($type) {
            $query->where('types.id', $type->id);
        })->with('types')->get();

        return response()->json(['restaurants' => $restaurants, 'label' => $type->label]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Verifica se l'utente ha un ristorante associato
        if ($user->restaurant) {
            $restaurant = $user->restaurant;
            return view('admin.restaurant.index', compact('restaurant'));
        } else {
            // Se l'utente non ha un ristorante associato, reindirizzalo alla pagina di creazione del ristorante
            return redirect()->route('admin.restaurant.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurant.create');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;

        return view('admin.restaurant.edit', compact('restaurant'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Verifica se l'utente ha un ristorante associato
        if ($user->restaurant) {
            $restaurant = $user->restaurant;
            return view('admin.home', compact('restaurant'));
        } else {
            // Se l'utente non ha un ristorante associato, reindirizzalo alla pagina di creazione del ristorante
            return redirect()->route('admin.restaurants.create');
        }
    }
}

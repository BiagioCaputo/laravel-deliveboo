<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Recupera l'id del ristorante associato ai piatti
        $restaurant_id = Auth::user()->restaurant->id;

        // Recupera solo i piatti con lo stesso ID del ristorante
        $orders = Order::whereRestaurantId($restaurant_id)->orderByDesc('created_at')->paginate(5)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }
}

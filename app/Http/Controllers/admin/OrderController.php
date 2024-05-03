<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
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

    public function show(Order $order)
    {
        if ($order->restaurant->id !== Auth::user()->restaurant->id) {
            abort(404);
        }

        $restaurant = Restaurant::findOrFail($order->restaurant_id);

        return view('admin.orders.show', compact('order', 'restaurant'));
    }

    public function statistics(Request $request)
    {
        // Recupera l'id del ristorante associato ai piatti
        $restaurant_id = Auth::user()->restaurant->id;

        // Recupera solo i piatti con lo stesso ID del ristorante
        $orders = Order::whereRestaurantId($restaurant_id)->orderByDesc('created_at')->get();

        return view('admin.orders.statistics', compact('orders'));
    }
}

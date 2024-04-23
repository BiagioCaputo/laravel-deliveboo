<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::select('label', 'id')->get();

        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'activity_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'vat' => ['required', 'string', 'unique:restaurants'],
            'restaurant_types' => ['required', 'array'],
            'restaurant_types.*' => ['exists:types,id']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        $restaurant = new Restaurant([
            'activity_name' => $request->activity_name,
            'address' => $request->address,
            'vat' => $request->vat,
            'phone' => $request->phone,
            'description' => $request->description,
            'user_id' => $user->id // Collegamento con l'ID dell'utente appena creato
        ]);

        $restaurant->save();

        // Aggiungi i tipi di ristorante selezionati
        $restaurant->types()->attach($request->restaurant_types);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

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
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        // dd($request);
        $request->validate(
            [
                'name' => ['required', 'unique:users,name', 'string', 'min:5', 'max:50'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => ['required', 'same:password', Rules\Password::defaults()],
                'activity_name' => ['required', 'string'],
                'address' => ['required', 'string'],
                'vat' => ['required', 'string', 'size:11', 'unique:restaurants,vat'],
                'restaurant_types' => ['required', 'array', 'min:1'], //deve esserci almeno una tipologia
                'restaurant_types.*' => ['exists:types,id']
            ],
            [
                'name.required' => 'Inserire un username',
                'name.unique' => 'Username già esistente',
                'name.min' => 'Minimo :min caratteri',
                'name.max' => 'Massimo :max caratteri',
                'email.required' => 'Inserire un indirizzo e-mail',
                'email.unique' => 'Indirizzo e-mail già associato ad un username',
                'email.lowercase' => 'Inserire l\'indirizzo e-mail con caratteri minuscoli',
                'email.email' => 'Inserire un indirizzo e-mail valido',
                'email.max' => 'Inserire un indirizzo e-mail valido',
                'password.required' => 'Inserire una password',
                'password.confirmed' => 'Le password non coincidono',
                'password.min' => 'La password deve avere almeno :min caratteri',
                'password_confirmation.required' => 'Inserire la password',
                'password_confirmation.same' => 'Le password non coincidono',
                'activity_name.required' => 'Inserire una ragione sociale',
                'address.required' => 'Inserire un indirizzo',
                'vat.required' => 'Inserire una partita iva',
                'vat.unique' => 'Partita iva già associata ad un username',
                'vat.size' => 'La partita iva deve avere :size caratteri',
                'restaurant_types.required' => 'ATTENZIONE: Selezionare almeno una tipologia',
                'restaurant_types.min' => 'Selezionare almeno una tipologia',
            ]
        );

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

        // Salva l'immagine
        if ($request->hasFile('image')) {
            $path = Storage::put('restaurant_images', $request->image);
            $restaurant->image = $path;
        }

        // Salva il logo
        if ($request->hasFile('logo')) {
            $path = Storage::put('restaurant_logos', $request->logo);
            $restaurant->logo = $path;
        }

        $restaurant->save();

        // Aggiungi i tipi di ristorante selezionati
        $restaurant->types()->attach($request->restaurant_types);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

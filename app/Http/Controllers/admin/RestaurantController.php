<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $restaurant = new Restaurant(); //creo un ristorante vuoto cosi posso gestire il create e l'edit con un form unico

        $types = Type::select('label', 'id')->get();

        return view('admin.restaurant.create', compact('restaurant', 'types'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'activity_name' => 'required|string|unique:restaurants',
                'address' => 'required|string',
                'email' => 'required|string',
                'vat' => 'required|string',
                'image' => 'nullable|image',
            ],
            [
                'activity_name.required' => 'Il ristorante deve avere un titolo',
                'address.required' => 'Il ristorante deve avere un indirizzo',
                'email' => 'Il ristorante deve avere una email',
                'vat' => 'Il ristorante deve avere una Partita IVA',
                'image.image' => 'Il file inserito non è un immagine',
            ]
        );

        // Ottieni l'ID dell'utente autenticato
        $userId = Auth::id();

        // Ottieni tutti i dati dal modulo
        $data = $request->all();

        $restaurant = new Restaurant();

        $restaurant->fill($data);

        // Assegna l'ID dell'utente al campo user_id
        $restaurant->user_id = $userId;

        // Genera lo slug per l'activity_name
        $restaurant->slug = Str::slug($restaurant->activity_name);

        //controllo se arriva un file
        if (Arr::exists($data, 'image')) {

            //salvo nella variabile extension l'estensione dell'immagine inserita dall'utente
            $extension = $data['image']->extension();

            //salvo nella variabile url e in restaurant images l'immagine rinominata con lo slug del progetto
            $img_url = Storage::putFileAs('restaurant_images', $data['image'], "$restaurant->slug.$extension");

            $restaurant->image = $img_url;
        }


        $restaurant->save();

        if (Arr::exists($data, 'types')) {
            $restaurant->types()->attach($data['types']);
        }



        return redirect()->route('admin.home')->with('message', "Ristorante creato con successo");
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;

        $types = Type::select('label', 'id')->get();

        //Ricavo le tipologie utilizzate dal progetto prima di modificarlo cosi da utilizzarle nell'old nel form
        $previous_types = $restaurant->types->pluck('id')->toArray();

        return view('admin.restaurant.edit', compact('restaurant', 'types', 'previous_types'));
    }


    public function update(Request $request, Restaurant $restaurant)
    {
        // dd($restaurant);

        $data = $request->validated();

        $slug = Restaurant::generateSlug($request->name);
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            if ($restaurant->image) {
                Storage::delete($restaurant->image);
            }
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $restaurant->update($data);

        if ($request->has('types')) {
            $restaurant->types()->sync($request->types);
        } else {
            $restaurant->types()->attach($request->types);
        }
        return redirect()->route('admin.restaurants.index')->with('message', "$restaurant->name aggiornato con successo");
    }
}

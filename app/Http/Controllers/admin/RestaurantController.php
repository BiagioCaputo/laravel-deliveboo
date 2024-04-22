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
                'types' => 'nullable|array', // Validazione per le tipologie esistenti
                'types.*' => 'exists:types,id', // Assicurati che i tipi esistenti siano presenti nel database
                'new_types.*.label' => 'nullable|string', // Validazione per le nuove tipologie

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


        //controllo se arriva un logo e lo salvo in restaurant_images
        if ($request->hasFile('logo')) {
            $path = Storage::put('restaurant_images', $request->logo);
            $data['logo'] = $path;
        }

        //controllo se arriva un immagine e la salvo in restaurant_images
        if ($request->hasFile('image')) {
            $path = Storage::put('restaurant_images', $request->image);
            $data['image'] = $path;
        }

        $restaurant = new Restaurant();

        $restaurant->fill($data);

        // Assegna l'ID dell'utente al campo user_id
        $restaurant->user_id = $userId;

        // Genera lo slug per l'activity_name
        $restaurant->slug = Str::slug($restaurant->activity_name);


        $restaurant->save();

        if (Arr::exists($data, 'types')) {
            $restaurant->types()->attach($data['types']);
        }

        // Salva le nuove tipologie se l'utente le ha inserite
        if (Arr::exists($request, 'new_types')) {
            foreach ($request['new_types'] as $newTypeData) {
                if (!empty($newTypeData['label'])) {
                    //creo una nuova tipologia e salvo subito il label fornito dall'utente
                    $type = new Type(['label' => $newTypeData['label']]);
                    //salvo la nuova tipologia
                    $type->save();
                    //la unisco al ristorante
                    $restaurant->types()->attach($type->id);
                }
            }
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

        //Ricavo le tipologie utilizzate dal Ristorante prima di modificarlo cosi da utilizzarle nell'old nel form
        $previous_types = $restaurant->types->pluck('id')->toArray();

        return view('admin.restaurant.edit', compact('restaurant', 'types', 'previous_types'));
    }


    public function update(Request $request, Restaurant $restaurant)
    { {
            $request->validate(
                [
                    'activity_name' => ['required', 'string', Rule::unique('restaurants')->ignore($restaurant->id)],
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

            $data = $request->all();

            $data['slug'] = Str::slug($data['activity_name']);

            //controllo se mi arriva un logo
            if ($request->hasFile('logo')) {
                //cancello il precedente logo
                if ($restaurant->logo) {
                    Storage::delete($restaurant->logo);
                }
                //salvo il nuovo logo
                $path = Storage::put('restaurant_images', $request->logo);
                $data['logo'] = $path;
            }

            //controllo se mi arriva un immagine
            if ($request->hasFile('image')) {
                //cancello la precedente immagine
                if ($restaurant->image) {
                    Storage::delete($restaurant->image);
                }
                //salvo la nuova immagine
                $path = Storage::put('restaurant_images', $request->image);
                $data['image'] = $path;
            }

            $restaurant->update($data);

            // se ho inviato uno o dei valori sincronizzo 
            if (Arr::exists($data, 'types')) $restaurant->types()->sync($data['types']);

            // Se non ho inviato valori ma il restaurant ne aveva in precedenza, vuol dire che devo eliminare valore perchè li ho tolti tutti
            elseif (!Arr::exists($data, 'types') && $restaurant->has('types')) $restaurant->types()->detach();

            // Salva le nuove tipologie se l'utente le ha inserite
            if (Arr::exists($request, 'new_types')) {
                foreach ($request['new_types'] as $newTypeData) {
                    if (!empty($newTypeData['label'])) {
                        //creo una nuova tipologia e salvo subito il label fornito dall'utente
                        $type = new Type(['label' => $newTypeData['label']]);
                        //salvo la nuova tipologia
                        $type->save();
                        //la unisco al ristorante
                        $restaurant->types()->attach($type->id);
                    }
                }
            }



            return to_route('admin.home', $restaurant->id)->with('type', 'success')->with('message', 'Ristorante modificato con successo');
        }
    }
}

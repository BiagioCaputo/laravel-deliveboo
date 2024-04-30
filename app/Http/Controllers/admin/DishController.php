<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class DishController extends Controller
{
    public function index(Request $request)
    {
        // Recupera l'id del ristorante associato ai piatti
        $restaurant_id = Auth::user()->restaurant->id;

        //termine cercato nella search bar
        $search = $request->query('search');

        //filtro selezionato per la portata
        $course_filter = $request->query('course_filter');

        // Recupera solo i piatti con lo stesso ID del ristorante
        $query = Dish::whereRestaurantId($restaurant_id)
            ->orderBy('name')
            ->orderByDesc('created_at')
            ->where('name', 'LIKE', "%$search%");

        // Se c'è un filtro per la portata, applicalo
        if ($course_filter) {
            $query->where('course_id', $course_filter);
        }

        $dishes = $query->paginate(5)->withQueryString();

        $courses = Course::select('label', 'id')->get();

        return view('admin.dishes.index', compact('dishes', 'courses', 'course_filter', 'search', 'restaurant_id'));
    }



    public function show(Dish $dish)
    {
        if ($dish->restaurant->id !== Auth::user()->restaurant->id) {
            abort(404);
        }

        $restaurant = Restaurant::findOrFail($dish->restaurant_id);
        return view('admin.dishes.show', compact('dish', 'restaurant'));
    }

    public function create()
    {
        // Istanzio un nuovo piatto
        $dish = new Dish();

        // Recuperi piatti già esistenti per la validazione
        $dishes = Dish::all();

        // Recupero le portate da poter associare al piatto
        $courses = Course::select('label', 'id')->get();
        return view('admin.dishes.create', compact('dish', 'courses', 'dishes'));
    }

    public function store(Request $request, Dish $dish)
    {
        // Valido i dati nella request
        $request->validate(
            [
                'name' => 'required|string',
                'image' => 'nullable|image',
                'ingredients' => 'required|string',
                'price' => 'required|decimal:2|min:0.01',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Il ristorante deve avere un titolo',
                'image.image' => 'Il file inserito non è un immagine',
                'ingredients.required' => 'Il piatto deve avere degli ingredienti',
                'price.required' => 'Il piatto deve avere un prezzo',
                'price.decimal' => 'Il prezzo deve avere :decimal decimali',
                'price.min' => 'Il prezzo deve essere maggiore di 0€',
                'description.string' => 'Inserire una descrizione valida',
            ]
        );

        // Recupero i dati dalla request
        $data = $request->all();

        // Imposta l'ID del ristorante associato all'utente loggato
        $data['restaurant_id'] = Auth::user()->restaurant->id;

        // Istanzio un nuovo piatto
        $dish = new Dish;

        if ($request->hasFile('image')) {
            $path = Storage::put('dish_images', $request->image);
            $data['image'] = $path;
        }

        // Gestisco la disponibilità verificando se esiste una chiave nell'array che mi arriva
        $dish->available = array_key_exists('available', $data);

        // Compilo i campi
        $dish->fill($data);

        // Salvo le modifiche nel DB
        $dish->save();

        return to_route('admin.dishes.index', compact('dish'))->with('message', 'Piatto creato con successo')
            ->with('type', 'success');;
    }

    public function edit(Dish $dish)
    {
        if ($dish->restaurant->id !== Auth::user()->restaurant->id) {
            abort(404);
        }
        // dd($dish);
        // Recupero le portate associate al piatto e le mando giù come semplice array
        $course_id = $dish->course_id;
        $ingredients = $dish->ingredients;
        $courses = Course::select('label', 'id')->get();

        // Recuperi piatti già esistenti per la validazione
        $dishes = Dish::all();

        return view('admin.dishes.edit', compact('dish', 'ingredients', 'course_id', 'courses', 'dishes'));
    }

    public function update(Request $request, Dish $dish)
    {
        // Valido i dati nella request
        $request->validate(
            [
                'name' => 'required|string',
                'image' => 'nullable|image',
                'ingredients' => 'required|string',
                'price' => 'required|decimal:2|min:0.01',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Il ristorante deve avere un titolo',
                'image.image' => 'Il file inserito non è un immagine',
                'ingredients.required' => 'Il piatto deve avere degli ingredienti',
                'price.required' => 'Il piatto deve avere un prezzo',
                'price.decimal' => 'Il prezzo deve avere :decimal decimali',
                'price.min' => 'Il prezzo deve essere maggiore di 0€',
                'description.string' => 'Inserire una descrizione valida',
            ]
        );

        // Recupero i dati dalla request
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($dish->image) {
                Storage::delete($dish->image);
            }

            $path = Storage::put('dish_images', $request->image);
            $data['image'] = $path;
        }

        // Gestisco la disponibilità verificando se esiste una chiave nell'array che mi arriva
        $dish->available = array_key_exists('available', $data);

        // Compilo i campi
        $dish->update($data);

        return to_route('admin.dishes.index', $dish)
            ->with('message', 'Piatto modificato con successo!')
            ->with('type', 'warning');
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();

        return to_route('admin.dishes.index')->with('type', 'warning')
            ->with('message', "Piatto spostato nel cestino!");
    }

    // SOFT DELETE

    public function trash()
    {
        $restaurant_id = Auth::user()->restaurant->id;
        $dishes = Dish::onlyTrashed()->whereRestaurantId($restaurant_id)->get();

        return view('admin.dishes.trash', compact('dishes'));
    }

    public function restore(Dish $dish)
    {
        $dish->restore();

        return to_route('admin.dishes.trash')
            ->with('type', 'success')
            ->with('message', "Piatto ripristinato con successo!");
    }

    // STRONG DELETE

    public function drop(Dish $dish)
    {
        if ($dish->image) {
            Storage::delete($dish->image);
        }

        $dish->forceDelete();

        return to_route('admin.dishes.trash')
            ->with('type', 'danger')
            ->with('message', "Piatto eliminato definitivamente!");
    }

    // MASSIVE DROP AND MASSIVE RESTORE

    public function massiveDrop()
    {
        $restaurant_id = Auth::user()->restaurant->id;

        // Recupero tutti i termini nel cestino
        $trashed_dish = Dish::onlyTrashed()->whereRestaurantId($restaurant_id)->get();

        // Se c'è qualcosa nel cestino
        if (count($trashed_dish)) {
            // Per ogni termine nel cestino...
            foreach ($trashed_dish as $dish) {
                if ($dish->image) {
                    Storage::delete($dish->image);
                }

                // Elimino definitivamente
                $dish->forceDelete();
            }

            $message = 'Cestino svuotato con successo!';
        }

        return to_route('admin.dishes.trash')->with('type', 'danger')
            ->with('message', $message);
    }

    public function massiveRestore()
    {
        $restaurant_id = Auth::user()->restaurant->id;

        // Recupero tutti i termini nel cestino
        $trashed_dish = Dish::onlyTrashed()->whereRestaurantId($restaurant_id)->get();

        // Preparo una variabile per inserire un messaggio
        $message = 'Il cestino è vuoto!';

        // Se c'è qualcosa nel cestino
        if (count($trashed_dish)) {
            // Per ogni termine nel cestino...
            foreach ($trashed_dish as $dish) {

                // Ripristino
                $dish->restore();
            }
            $message = 'Piatti ripristinati con successo!';
        }

        return to_route('admin.dishes.trash')->with('message', $message)->with('type', 'secondary');
    }
}

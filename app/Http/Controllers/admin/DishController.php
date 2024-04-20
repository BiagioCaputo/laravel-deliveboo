<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class DishController extends Controller
{
    public function index()
    {
        // Recuper tutti i piatti e li mando giù
        $dishes = Dish::all();
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        // Istanzio un nuovo piatto
        $dish = new Dish();

        // Recupero le portate da poter associare al piatto
        $courses = Course::select('label', 'id')->get();
        return view('admin.dishes.create', compact('dish', 'courses'));
    }

    public function store(Request $request, Dish $dish)
    {
        // Valido i dati nella request
        $request->validate(
            [
                'name' => 'required|string|unique:dishes',
                'image' => 'nullable|image',
                'ingredients' => 'required|string',
                'price' => 'required|decimal:2',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Il ristorante deve avere un titolo',
                'image.image' => 'Il file inserito non è un immagine',
                'ingredients.required' => 'Il piatto deve avere degli ingredienti',
                'price.required' => 'Il piatto deve avere un prezzo',
                'price.decimal' => 'Max :decimal decimali',
                'description.string' => 'Inserire una descrizione valida',
            ]
        );

        // Recupero i dati dalla request
        $data = $request->all();

        // Istanzio un nuovo piatto
        $dish = new Dish;

        // Compilo i campi
        $dish->fill($data);

        // Genera lo slug per l'activity_name
        $dish_slug = Str::slug($dish->name);

        //controllo se arriva un file
        if (Arr::exists($data, 'image')) {

            //salvo nella variabile extension l'estensione dell'immagine inserita dall'utente
            $extension = $data['image']->extension();

            //salvo nella variabile url e in dish images l'immagine rinominata con lo slug del piatto
            $img_url = Storage::putFileAs('dish_images', $data['image'], "$dish_slug.$extension");

            $dish->image = $img_url;
        }

        // Salvo le modifiche nel DB
        $dish->save();

        return to_route('admin.dishes.index', $dish);
    }

    public function edit(Dish $dish)
    {
        // dd($dish);
        // Recupero le portate associate al piatto e le mando giù come semplice array
        $course_id = $dish->course_id;
        $ingredients = $dish->ingredients;
        $courses = Course::select('label', 'id')->get();

        return view('admin.dishes.edit', compact('dish', 'ingredients', 'course_id', 'courses'));
    }

    public function update(Request $request, Dish $dish)
    {
        // Valido i dati nella request
        $request->validate(
            [
                'name' => ['required', 'string', Rule::unique('dishes')->ignore($dish->id)],
                'image' => 'nullable|image',
                'ingredients' => 'required|string',
                'price' => 'required|decimal:2',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Il ristorante deve avere un titolo',
                'image.image' => 'Il file inserito non è un immagine',
                'ingredients.required' => 'Il piatto deve avere degli ingredienti',
                'price.required' => 'Il piatto deve avere un prezzo',
                'price.decimal' => 'Max :decimal decimali',
                'description.string' => 'Inserire una descrizione valida',
            ]
        );

        // Recupero i dati dalla request
        $data = $request->all();

        // Compilo i campi
        $dish->update($data);

        // Genera lo slug per l'activity_name
        $dish_slug = Str::slug($dish->name);

        //controllo se arriva un file
        if (Arr::exists($data, 'image')) {

            // controllo se ho un altra immagine già esistente nella cartella e la cancello
            if ($dish->image) Storage::delete($dish->image);

            //salvo nella variabile extension l'estensione dell'immagine inserita dall'utente
            $extension = $data['image']->extension();

            //salvo nella variabile url e in dish images l'immagine rinominata con lo slug del piatto
            $img_url = Storage::putFile('dish_images', $data['image'], "$dish_slug.$extension");

            $dish->image = $img_url;
        }

        return to_route('admin.dishes.index', $dish);
    }
}
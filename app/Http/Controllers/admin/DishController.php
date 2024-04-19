<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Dish;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $dish = new Dish();
        $courses = Course::select('label')->get();
        return view('admin.dishes.create', compact('dish', 'courses'));
    }

    public function store()
    {

        return to_route('admin.dishes.index');
    }

    public function edit()
    {
        return 'Questa è la pagina di edit';
    }

    public function update()
    {
        return 'Questa è la pagina di update';
    }
}

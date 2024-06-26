<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['course_id', 'name', 'image', 'ingredients', 'price', 'description', 'available', 'restaurant_id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // Funzione per il percorso dell'immagine
    public function getImage()
    {
        return asset('storage/' . $this->image);
    }

    // Funzione per renderizzare il prezzo con la valuto
    public function getPrice()
    {
        return ($this->price . '€');
    }

    //funzione per montare la stringa per le immagini cosi da rendere la vita facile al front
    public function image(): Attribute
    {
        return Attribute::make(fn ($value) => $value && app('request')->is('api/*') ? url('storage/' . $value) : $value);
    }
}

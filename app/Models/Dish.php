<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

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
        return asset('storage' . $this->image);
    }

    // Funzione per renderizzare il prezzo con la valuto
    public function getPrice()
    {
        return ($this->price . '€');
    }
}

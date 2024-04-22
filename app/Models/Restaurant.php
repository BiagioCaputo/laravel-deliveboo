<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['activity_name', 'address', 'image', 'slug', 'vat', 'email', 'type_id', 'description', 'logo', 'opening_hour', 'closing_hour', 'opening_days'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }


    //funzione per cambiare il format delle date
    public function getFormattedDate($column, $format = 'd-m-Y')
    {
        return Carbon::create($this->$column)->format($format);
    }

    //funzione per centralizzare il percorso dell'immagine per arrivare allo storage
    public function printImage()
    {
        return asset('storage/' . $this->image);
    }

    //funzione per centralizzare il percorso del logo per arrivare allo storage
    public function printLogo()
    {
        return asset('storage/' . $this->logo);
    }
}

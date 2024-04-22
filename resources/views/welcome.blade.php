{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Deliveboo')

{{-- Contenuto principale pagina --}}

@section('content')

{{-- Sezione introduttiva --}}
<div class="jumbotron d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-center align-items-center">
        <img src="img/glovo_logo.png" alt="logo glovo">
        <div>
            <h1>Le tue funzionalità <br> in un'unica App </br> </h1>
            <p>Scopri tutte le funzionalità che DeliveBoo offre ai propri partner!</p>
            <a class="btn btn-primary me-1" href="{{ url('/register') }}">Registrati</a>
            <a class="btn btn-primary" href="{{ url('/login') }}">Accedi</a>
        </div>
    </div>
</div>
<img src="img/jumbotron-wave-desktop.svg" alt="Wave" class="wave">


@endsection
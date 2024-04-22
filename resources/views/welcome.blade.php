{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Deliveboo')

{{-- Contenuto principale pagina --}}

@section('content')

{{-- Sezione introduttiva --}}
<div class="section-3 d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-center align-items-center">
        <img src="img/glovo_logo.png" alt="logo glovo">
        <div>
            <h1 class="pb-4">Le tue funzionalità <br> in un unico posto </br> </h1>
            <p class="pb-4">Scopri tutte le funzionalità che DeliveBoo offre ai propri partner!</p>
            <a class="btn btn-primary me-1" href="{{ url('/register') }}">Registrati Ora</a>
            <a class="btn btn-primary" href="{{ url('/login') }}">Accedi</a>
        </div>
    </div>
</div>
<img src="img/jumbotron-wavedesktop.svg" alt="Wave">
<!-- <img src="../../public/img/jumbotron-wave-desktop.svg" alt="Wave"> -->


@endsection
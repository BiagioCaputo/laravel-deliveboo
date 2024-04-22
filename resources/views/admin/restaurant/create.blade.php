{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Crea ristorante')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-5">Inserisci i dati del tuo Ristorante</h1>
    </header>

    {{-- Form per la modifica di un progetto --}}
    <div class="container">
        @include('includes.restaurant.form')
    </div>

@endsection


{{-- Scripts --}}
@section('scripts')
    @vite('resources/js/logo_preview.js')
    @vite('resources/js/image_preview.js')
@endsection

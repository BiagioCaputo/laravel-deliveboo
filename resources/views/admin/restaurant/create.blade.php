{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Crea ristorante')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-2">Inserisci i dati del tuo Ristorante</h1>
    </header>

    {{-- Form per la modifica di un progetto --}}
    <div class="container">
        @include('includes.restaurant.form')
    </div>

@endsection


{{-- Scripts --}}
@section('scripts')
    {{-- @vite('resources/js/slug_field.js') --}}
    @vite('resources/js/image_preview.js')
@endsection

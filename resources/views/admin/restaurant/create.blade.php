{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'New_Restaurant')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-5">Inserisci i dati del tuo Ristorante</h1>
    </header>

    {{-- Form per la modifica di un progetto --}}
    <div class="container py-5">
        @include('includes.restaurant.form')
    </div>

@endsection


{{-- Scripts --}}
@section('scripts')
    {{-- @vite('resources/js/slug_field.js') --}}
    @vite('resources/js/image_preview.js')
@endsection

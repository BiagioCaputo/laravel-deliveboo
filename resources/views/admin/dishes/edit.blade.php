{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Modifica piatto')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-5">Modifica il tuo piatto</h1>
    </header>

    {{-- Form per la modifica di un progetto --}}
    <div class="container py-2">
        @include('includes.dishes.form')
    </div>

@endsection



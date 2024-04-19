{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', '{{ $dish->name }}')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-3">{{ $dish->name }}</h1>
    </header>

    <main>
        {{-- Form per la modifica di un progetto --}}
        <div class="container py-2">
        </div>
    </main>

@endsection


{{-- Scripts --}}
@section('scripts')
    {{-- @vite('resources/js/slug_field.js') --}}
    {{-- @vite('resources/js/image_preview.js') --}}
@endsection

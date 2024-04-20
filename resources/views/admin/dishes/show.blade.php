{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', '{{ $dish->name }}')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-3">{{ $dish->name }}</h1>
    </header>

    {{-- Form per la modifica di un progetto --}}
    <div class="container py-2">
    </div>

@endsection


{{-- Scripts --}}
@section('scripts')

@endsection

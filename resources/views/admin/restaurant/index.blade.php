{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'My restaurant')

{{-- Contenuto principale pagina --}}

@section('content')

    <header>
        <h1 class="text-center my-5">{{ $restaurant->activity_name }}</h1>
    </header>
    <div class="container">
        <div class="clearfix">
            @if ($restaurant->image)
                <img src="{{ $restaurant->printImage() }}" alt="{{ $restaurant->activity_name }}" class="me-2 float-start">
            @endif
            <p>{{ $restaurant->description }}</p>
            <ul class="list-unstyled">
                <li>{{ $restaurant->address }}</li>
                <li>{{ $restaurant->vat }}</li>
                <li>{{ $restaurant->email }}</li>
            </ul>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="me-2"><strong>Creato il:</strong>{{ $restaurant->getFormattedDate('created_at') }}</div>
                    <div><strong>Modificato il:</strong> {{ $restaurant->getFormattedDate('updated_at') }}</div>
                </div>
                <div x-data="{ isOpen: false }">
                    <a @click="isOpen = !isOpen" class="btn btn-primary my-3">Mostra tipologie</a>
                    <div x-show="isOpen">
                        <div class="d-flex gap-2">
                            @forelse($restaurant->types as $type)
                                <span>{{ $type->label }}</span>
                            @empty
                                -
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr>
    </div>

    <footer>
        <div class="container py-5 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.restaurant.edit', $restaurant) }}" class="btn btn-warning"><i
                        class="fas fa-pencil me-2"></i>Modifica</a>
            </div>
            <div>
                <a href="{{ route('admin.dishes.index', $restaurant) }}" class="btn btn-success"><i
                        class="fa-solid fa-utensils me-2"></i>Menù</a>
            </div>
        </div>
    </footer>

@endsection

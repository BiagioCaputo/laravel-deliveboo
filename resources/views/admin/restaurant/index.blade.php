{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'My restaurant')


{{-- Contenuto principale pagina --}}

@section('content')

    <header>
        <h1 class="text-center my-5">{{ $restaurant->activity_name }}</h1>
    </header>
    <div class="container py-5">
        <div class="clearfix">
            @if ($restaurant->image)
                <img src="{{ $restaurant->printImage() }}" alt="{{ $restaurant->activity_name }}" class="me-2 float-start">
            @endif
            <ul class="list-unstyled">
                <li>{{ $restaurant->address }}</li>
                <li>{{ $restaurant->vat }}</li>
                <li>{{ $restaurant->email }}</li>
            </ul>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="me-2"><strong>Creato il:</strong>
                        {{ $restaurant->getFormattedDate('created_at') }}</span>
                    <span><strong>Modificato il:</strong> {{ $restaurant->getFormattedDate('updated_at') }}</span>
                </div>
                <div class="d-flex gap-2">
                    @forelse($restaurant->types as $type)
                        <span>{{ $type->label }}</span>
                    @empty
                        -
                    @endforelse
                </div>
            </div>

        </div>
        <hr>
    </div>

    <footer>
        <div class="container py-5 d-flex justify-content-end align-items-center">
            <div>
                <a href="{{ route('admin.restaurant.edit', $restaurant) }}" class="btn btn-warning"><i
                        class="fas fa-pencil me-2"></i>Modifica</a>
            </div>
        </div>
    </footer>

@endsection

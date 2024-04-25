{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', '{{ $dish->name }}')

{{-- Contenuto principale pagina --}}
@section('content')

    <div class="background-container" style="background-image: url('{{ $restaurant->printImage() }}' ); filter: blur(5px);">
    </div>

    <div class="container">
        <div class="clearfix">
            <div class="card card-deliveboo my-5"> {{-- TODO margine messo per far vedere --}}

                <div id="food-box">
                    @if ($restaurant->image)
                        <img src="{{ $dish->getImage() }}" alt="{{ $restaurant->activity_name }}">
                    @endif
                </div>
                <h1>{{ $dish->name }}</h1>
                <p><strong>Descrizione: </strong>{{ $dish->description }}</p>
                <ul class="list-unstyled">
                    <li><strong>Prezzo: </strong>{{ $dish->getPrice() }}</li>
                    <li><strong>Ingredienti: </strong>{{ $dish->ingredients }}</li>
                    <li><strong>Visibile: </strong>{{ $dish->available ? 'Sì' : 'No' }}</li>
                </ul>
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <div>
                        <div class="me-2"><strong>Creato il: </strong>{{ $restaurant->getFormattedDate('created_at') }}
                        </div>
                        <div><strong>Modificato il: </strong>{{ $restaurant->getFormattedDate('updated_at') }}</div>
                    </div>
                </div>

                <footer>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil me-2"></i>Modifica</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.dishes.index', $restaurant) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-utensils me-2"></i>Menù</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection




{{-- Scripts --}}
@section('scripts')
@endsection

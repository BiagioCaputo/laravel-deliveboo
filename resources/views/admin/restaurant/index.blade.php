{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'My restaurant')

{{-- Contenuto principale pagina --}}

@section('content')

<div class="background-container" style="background-image: url('{{ $restaurant->printImage() }}' ); filter: blur(5px);">
</div>

<div class="container">
    <div class="clearfix">
        <div class="card card-deliveboo my-5"> {{-- TODO margine messo per far vedere --}}

            <div id="logo-box">
                @if ($restaurant->image)
                <img src="{{ $restaurant->printLogo() }}" alt="{{ $restaurant->activity_name }}">
                @endif
            </div>
            <h1>{{ $restaurant->activity_name }}</h1>
            <p><strong>Descrizione: </strong>{{ $restaurant->description }}</p>

            <div class="card-bottom">
                <ul class="list-unstyled">
                    <li><strong>Indirizzo: </strong>{{ $restaurant->address }}</li>
                    <li><strong>Partita IVA: </strong>{{ $restaurant->vat }}</li>
                    <li><strong>E-mail: </strong>{{ $user->email }}</li>
                    <li><strong>Numero telefonico: </strong>{{ $restaurant->phone }}</li>
                    <li><strong>Creato il: </strong>{{ $restaurant->getFormattedDate('created_at') }}</li>
                    <li><strong>Modificato il: </strong>{{ $restaurant->getFormattedDate('updated_at') }}</li>
                </ul>

                <div class="types">

                    <ul class="list-unstyled">
                        <li><strong>Categorie</strong></li>
                        @forelse($restaurant->types as $type)
                        <li>{{ $type->label }}</li>
                        @empty
                        No type
                        @endforelse
                    </ul>
                </div>
            </div>


            <div class="d-flex justify-content-between align-items-center mt-5">
                {{-- <div>
                    <a href="{{ route('admin.restaurant.edit', $restaurant) }}" class="btn btn-warning"><i class="fas fa-pencil me-2"></i>Modifica</a>
                </div> --}}
                <div>
                    <a href="{{ route('admin.dishes.index', $restaurant) }}" class="btn btn-primary"><i class="fa-solid fa-utensils me-2"></i>Menù</a>
                </div>
                <div>
                    <a href="{{ route('admin.orders.index', $restaurant) }}" class="btn btn-info"><i class="fa-solid fa-utensils me-2"></i>Ordini</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
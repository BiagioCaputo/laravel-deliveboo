{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Piatti')

{{-- Contenuto principale pagina --}}
@section('content')

<header>
    <h1 class="text-center my-3">Lista piatti</h1>
</header>

<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center">

        {{-- Creazione nuovo piatto --}}
        <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>Nuovo piatto
        </a>

        {{-- Filtri Ricerca --}}
        <div>
            <form action="{{ route('admin.dishes.index') }}" method="GET">
                <div class="d-flex align-items-center gap-2">
                    {{-- Filtro Portata --}}
                    <select class="form-select" name="course_filter">
                        <option value="">Tutte le portate</option>
                        @foreach ($courses as $course)
                        <option value={{ $course->id }} @if ($course_filter==$course->id) selected @endif>
                            {{ $course->label }}
                        </option>
                        @endforeach
                    </select>

                    {{-- Search bar --}}
                    <input type="search" class="form-control" placeholder="Cerca Piatto" name="search" value="{{ $search }}" autofocus>

                    {{-- Button form --}}
                    <button class="btn btn-outline-secondary">Filtra</button>

                    {{-- Reset filter --}}
                    <a class="btn btn-outline-secondary" href="{{ route('admin.dishes.index', $restaurant_id) }}">Reset</a>

                </div>

            </form>
        </div>



    </div>

    {{-- Lista dei piatti --}}
    <div class="card card-deliveboo table-dish my-4">

        <table class="table table-striped ">
            <thead>
                <tr>
                    <th scope="col">Piatto</th>
                    <th scope="col" class="dish-992">Immagine</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col" class="dish-786">Descrizione</th>
                    <th scope="col">Disponibilità</th>
                    <th scope="col" class="dish-786">Portata</th>
                    <th scope="col">
                        {{-- Cestino --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.dishes.trash') }}" class="btn btn-danger">
                                <i class="fa-solid fa-trash me-2"></i>Cestino
                            </a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dishes as $dish)
                <tr>
                    <th scope="row">{{ $dish->name }}</th>
                    <td class="dish-992"><img class="img-table" src="{{ $dish->getImage() }}" alt="{{ $dish->name }}">
                    </td>
                    <td>{{ $dish->getPrice() }}</td>
                    <td class="dish-786">{{ $dish->description }}</td>
                    <td class="text-center">{{ $dish->available ? 'Sì' : 'No' }}</td>
                    <td class="dish-786">
                        @if ($dish->course)
                        <span class="text-capitalize">{{ $dish->course->label }}</span>
                        @else
                        <span>Non disponibile</span>
                        @endif
                    </td>
                    <td>
                        <div class="gap-2 crud-group">
                            <!--View-->
                            <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-primary btn-custom"><i class="fas fa-eye "></i></a>
                            <!--Edit-->
                            <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-warning btn-custom"><i class="fas fa-pencil "></i></a>
                            <!--Soft Delete-->
                            <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-dish="{{ $dish->name }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-custom"><i class="fas fa-trash-can"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <h3 class="text-center my-2">Non ci sono piatti</h3>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($dishes->hasPages())
    {{ $dishes->links() }}
    @endif
</div>

@endsection


{{-- Scripts --}}
@section('scripts')
@vite('resources/js/delete_confirmation.js')
@endsection
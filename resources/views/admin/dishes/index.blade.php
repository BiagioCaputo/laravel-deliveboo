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
            <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Nuovo
                piatto</a>

            {{-- Cestino --}}
            <a href="{{ route('admin.dishes.trash') }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i>
                Cestino</a>

        </div>

        {{-- Lista dei piatti --}}
        <table class="table table-striped my-4">
            <thead>
                <tr>
                    <th scope="col">Piatto</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Disponibilità</th>
                    <th scope="col">Portata</th>
                    <th scope="col" class="text-center">Comandi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dishes as $dish)
                    <tr>
                        <th scope="row">{{ $dish->name }}</th>
                        <td><img class="img-fluid" src="{{ $dish->getImage() }}" alt="{{ $dish->name }}"></td>
                        <td>{{ $dish->getPrice() }}</td>
                        <td>{{ $dish->description }}</td>
                        <td>{{ $dish->available ? 'Sì' : 'No' }}</td>
                        <td>
                            @if ($dish->course)
                                <span class="badge rounded-pill text-bg-info">{{ $dish->course->label }}</span>
                            @else
                                <span class="badge rounded-pill text-bg-dark">Non disponibile</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-primary"><i
                                    class="fas fa-eye "></i></a>
                                <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-warning"><i
                                        class="fas fa-pencil "></i></a>
                                <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST"
                                    class="delete-form" data-bs-toggle="modal" data-bs-target="#modal"
                                    data-dish="{{ $dish->name }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <h3>Piatti non caricati</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection


{{-- Scripts --}}
@section('scripts')
    @vite('resources/js/delete_confirmation.js')
@endsection

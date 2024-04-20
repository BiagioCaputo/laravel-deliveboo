{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Cestino')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-3">Cestino</h1>
    </header>

    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center">

            <h1 class="py-3">Cestino</h1>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between align-items-center gap-2">

                {{-- Lista Piatti --}}
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary btn-sm"><i
                        class="fa-solid fa-arrow-left"></i>
                    Lista Piatti</a>

                {{-- Ripristino massivo --}}
                <form method="POST" action="{{ route('admin.dishes.massive-restore') }}" class="btn btn-success btn-sm"
                    onclick="this.submit()">
                    <i class="fa-solid fa-rotate-left"></i>
                    @csrf
                    @method('PATCH')
                    Ripristina tutti
                </form>

                {{-- Cancellazione massiva --}}
                <form method="POST" action="{{ route('admin.dishes.massive-drop') }}" class="delete-form"
                    data-bs-toggle="modal" data-bs-target="#modal">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-regular fa-trash-can"></i>
                        Svuota
                        cestino</button>
                </form>
            </div>
        </div>

        {{-- Lista dei piatti --}}
        <table class="table table-striped my-4">
            <thead>
                {{-- Titoli tabella --}}
                <tr>
                    <th scope="col">Piatto</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Disponibilità</th>
                    <th scope="col">Portata</th>
                    <th scope="col">Modifica</th>
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
                            {{-- Buttons --}}
                            <div class="d-flex gap-1 justify-content-end">

                                {{-- Ripristino piatto --}}
                                <form action="{{ route('admin.dishes.restore', $dish->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm"><i
                                            class="fa-solid fa-rotate-left"></i></button>
                                </form>

                                {{-- <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a> --}}

                                {{-- Cancellazione definitiva piatto --}}
                                <form class="delete-form" action="{{ route('admin.dishes.drop', $dish->id) }}"
                                    method="POST" data-bs-toggle="modal" data-bs-target="#modal"
                                    data-dish="{{ $dish->name }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <h3 class="text-center my-2">Cestino vuoto</h3>
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

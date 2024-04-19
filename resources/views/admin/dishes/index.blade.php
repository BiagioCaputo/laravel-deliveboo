{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Piatti')

{{-- Contenuto principale pagina --}}
@section('content')

    <header>
        <h1 class="text-center my-3">Lista piatti</h1>
    </header>

    <main>

        <div class="container py-2">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Nuovo
                    piatto</a>
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
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-warning"><i
                                            class="fas fa-pencil "></i></a>
                                    {{-- <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                        class="delete-form" data-bs-toggle="modal" data-bs-target="#modal">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-trash-can"></i></button>
                                    </form> --}}
                                </div>
                            </td>
                            {{-- <td>
                                @forelse ($project->technologies as $technology)
                                    <img src="{{ $technology->renderLogos() }}" class="img-fluid my-image" alt="">
                                @empty
                                    <span class="badge rounded-pill text-bg-secondary">No technologies</span>
                                @endforelse
                            </td>
                            <td>{{ $project->is_completed ? 'Yes' : 'No' }}</td>
                            <td>{{ $project->getFormatDate('created_at', 'm-Y') }}</td>
                            <td>{{ $project->getFormatDate('updated_at', 'm-Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning"><i
                                            class="fas fa-pencil "></i></a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                        class="delete-form" data-bs-toggle="modal" data-bs-target="#modal">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td> --}}
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
    </main>

@endsection


{{-- Scripts --}}
@section('scripts')
    {{-- @vite('resources/js/slug_field.js') --}}
    {{-- @vite('resources/js/image_preview.js') --}}


@endsection

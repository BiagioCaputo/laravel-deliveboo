@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-auto col-lg-8">
                <div class="card">
                    <div class="card-header fs-2">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate
                            id="register-form">
                            @csrf

                            {{-- Nome ristoratore --}}
                            <div class="row mb-3">
                                <label for="name" class="col-form-label fw-bold">{{ __('Nome utente') }}</label>
                                <div class="col-12">
                                    <input id="name" type="text"
                                        class="form-control
                                        @error('name') is-invalid @elseif (old('name', '')) is-valid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="Crea username" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <label for="email" class="col-form-label fw-bold">{{ __('E-mail') }}</label>

                                <div class="col-12">
                                    <input id="email" type="email"
                                        class="form-control
                                        @error('email') is-invalid @elseif (old('email', '')) is-valid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Inserisci la tua e-mail"
                                        required autocomplete="email">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0" id="email-suggest">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="row mb-3">
                                <label for="password" class="col-form-label fw-bold">{{ __('Password') }}</label>

                                <div class="col-12">
                                    <input id="password" type="password"
                                        class="form-control
                                        @error('password') is-invalid @enderror"
                                        name="password" placeholder="Crea password" required autocomplete="new-password">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Conferma password --}}
                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-form-label fw-bold">{{ __('Conferma Password') }}</label>

                                <div class="col-12">
                                    <input id="password-confirm" type="password"
                                        class="form-control
                                    @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" placeholder="Conferma password" required
                                        autocomplete="new-password">

                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Nome dell'attività --}}
                            <div class="row mb-3">
                                <label for="activity_name"
                                    class="col-form-label fw-bold">{{ __('Ragione Sociale') }}</label>

                                <div class="col-12">
                                    <input id="activity_name" type="text"
                                        class="form-control
                                        @error('activity_name') is-invalid @elseif (old('activity_name', '')) is-valid @enderror"
                                        name="activity_name" value="{{ old('activity_name') }}" placeholder="es: Deliveboo"
                                        required autocomplete="activity_name">

                                    @error('activity_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            {{-- Indirizzo dell'attività --}}
                            <div class="row mb-3">
                                <label for="address" class="col-form-label fw-bold">{{ __('Indirizzo') }}</label>

                                <div class="col-12">
                                    <input id="address" type="text"
                                        class="form-control
                                        @error('address') is-invalid @elseif (old('address', '')) is-valid @enderror"
                                        name="address" value="{{ old('address') }}"
                                        placeholder="es: Via Pippo, 116 - Domodossola" required autocomplete="address">

                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Partita IVA --}}
                            <div class="row mb-3">
                                <label for="vat" class="col-form-label fw-bold">{{ __('Partita Iva') }}</label>

                                <div class="col-12">
                                    <input id="vat" type="text"
                                        class="form-control
                                        @error('vat') is-invalid @elseif (old('vat', '')) is-valid @enderror"
                                        name="vat" value="{{ old('vat') }}" placeholder="Inserisci la tua P.IVA"
                                        required autocomplete="vat">

                                    @error('vat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @else
                                        <div class="form-text">
                                            <p class="m-0">campo obbligatorio*</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="row mb-3">
                                <label for="phone" class="col-form-label fw-bold ">{{ __('Telefono') }}</label>

                                <div class="col-12">
                                    <input id="phone" type="text"
                                        class="form-control
                                        @error('phone') is-invalid @elseif (old('phone', '')) is-valid @enderror"
                                        name="phone" value="{{ old('phone') }}" placeholder="es: +39 3335556660"
                                        autocomplete="phone">

                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Descrizione --}}
                            <div class="row mb-3">
                                <label for="description" class="col-form-label fw-bold">{{ __('Descrizione') }}</label>

                                <div class="col-12">
                                    <textarea id="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                                        name="description" value="{{ old('description') }}" autocomplete="description"
                                        placeholder="Inserisci una breve descrizione della tua attività" autofocus></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Immagine --}}
                            <div class="row mb-3">
                                <label for="image" class="col-form-label fw-bold">{{ __('Immagine') }}</label>

                                <div class="col-12">
                                    <input id="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Logo --}}
                            <div class="row mb-3">
                                <label for="logo" class="col-form-label fw-bold">{{ __('Logo') }}</label>

                                <div class="col-12">
                                    <input id="logo" type="file"
                                        class="form-control @error('logo') is-invalid @enderror" name="logo">

                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            {{--  Tipologie Ristorante --}}
                            <div class="row mb-3">
                                <label for="restaurant_types" class="col-form-label fw-bold py-0">
                                    {{ __('Seleziona una o più tipologie ristorante') }} <br>
                                </label>
                                <div class="form-text">
                                    <p class="m-0">Selezionare almeno una tipologia*</p>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 my-4">
                                    @foreach ($types as $type)
                                        <input type="checkbox"
                                            class="btn-check
                                        @error('restaurant_types') is-invalid @enderror"
                                            name="restaurant_types[]" id="type-{{ $type->id }}"
                                            value="{{ $type->id }}" required autocomplete="off">
                                        <label class="btn btn-deliveboo"
                                            for="type-{{ $type->id }}">{{ $type->label }}</label><br>
                                    @endforeach
                                    @error('restaurant_types')
                                        <div class="invalid-feedback">
                                            <hr>
                                            {{ $message }}
                                            <hr>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tasto conferma --}}
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal" id="send-form-button">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/client_validation.js')
@endsection

<script>
    const users = @json($users);;
</script>

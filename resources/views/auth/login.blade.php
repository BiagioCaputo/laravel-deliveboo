@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-auto col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="m-0">{{ __('Login') }}</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" novalidate id="login-form">
                            @csrf

                            <div class="mb-4 row">
                                <label for="email" class="col-form-label fw-bold">{{ __('Indirizzo Email') }}</label>

                                <div class="col-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="form-text">
                                        <p class="m-0" id="email-suggest"></p>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-form-label fw-bold">{{ __('Password') }}</label>

                                <div class="col-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    <div class="form-text">
                                        <p class="m-0" id="password-suggest"></p>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" id="send-button">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Hai dimenticato la password?') }}
                                        </a>
                                    @endif
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
    @vite('resources/js/login_validation.js')
@endsection

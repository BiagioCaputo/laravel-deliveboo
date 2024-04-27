@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-auto col-lg-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h4 class="m-0">
                            {{ __('Reset Password') }}
                        </h4>
                    </div>



                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" novalidate id="forgot-password-form">
                            @csrf

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-form-label fw-bold text-start">{{ __('Indirizzo Email') }}</label>

                                <div class="col-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="form-text">
                                        <p class="m-0 text-start" id="email-suggest"></p>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" id="send-button">
                                        {{ __('Invia in link di reset password') }}
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
    @vite('resources/js/forgot_password_validation.js')
@endsection

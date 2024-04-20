<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <div class="logo_deliveboo">
                <img src="https://www.biancolapisdesign.it/Blog/wp-content/uploads/2018/09/Logo-deliveroo-.jpg"
                    style="width:60px">
            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item d-flex">
                    <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                    <a class="nav-link" href="{{ route('admin.dishes.index') }}">I miei piatti</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto d-flex align-items-center">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('admin') }}">{{ __('Il mio ristorante') }}</a>
                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

            <!-- Bootstrap theme switch -->
            <div class="form-check form-switch ms-5">
                <input class="form-check-input" type="checkbox" role="button" id="darkModeSwitch">
                <label class="form-check-label" for="darkModeSwitch" id="darkModeLabel"></label>
            </div>
        </div>
    </div>
</nav>

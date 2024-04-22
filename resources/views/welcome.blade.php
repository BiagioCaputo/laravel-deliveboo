{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Deliveboo')

{{-- Contenuto principale pagina --}}

@section('content')

{{-- Sezione introduttiva --}}
<div class="section-3 d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-center align-items-center">
        <img src="img/glovo_logo.png" alt="logo glovo">
        <div>
            <h1 class="pb-4">Le tue funzionalità <br> in un unico posto </br> </h1>
            <p class="pb-4">Scopri tutte le funzionalità che DeliveBoo offre ai propri partner!</p>
            <a class="btn btn-primary me-1" href="{{ url('/register') }}">Registrati Ora</a>
            <a class="btn btn-primary" href="{{ url('/login') }}">Accedi</a>
        </div>
    </div>
</div>
<img src="img/jumbotron-wavedesktop.svg" alt="Wave">
<!-- <img src="../../public/img/jumbotron-wave-desktop.svg" alt="Wave"> -->


{{-- Sezione partner --}}
{{-- <div class="d-flex justify-content-center align-items-center my-5">
    <div class="section-2 d-flex justify-content-center align-items-center">
        <div>
            <img src="img/partners-image-opt.png">
        </div>
        <div>
            <h1 class="pt-5 mt-5">Diventa un partner</h1>
            <h5 class="pt-4">Cresci con Glovo! La nostra tecnologia e bacino di utenza può aiutarti ad acquisire nuovi clienti e sbloccare nuove opportunità!</h5>
        </div>    
    </div>
</div> --}}




{{-- Footer --}}

{{-- <footer>
    <img src="/img/footer-wave-desktop.svg" alt="footer-wave">
    <div class="bg-footer">
        <div class="container">

            <div class="logo">
                <h1 class="logo-text">DeliveBoo
                    <img src="/img/glovo_logo.png" alt="Logo" class="logo-img">
                </h1>
            </div>
            <div class="d-flex justify-content-between py-5 text-center list-container">
                <div v-for="(links, i) in store.footerLinks" :key="i" class="text-white">
                    <div>

                        <h4 class="link-title mb-4"></h4>
                        <ul>
                            <a href="#">
                                <li v-for="(link, i) in links.links" key="i" class="mb-4">
                                  
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
                <ul class="text-white text-center">
                    <a href="#">
                        <li class="mb-4">
                            <div class="download">
                                <i class="fa-brands fa-apple fa-xl"></i>
                                Scarica per apple (da finire)
                            </div>
                        </li>
                    </a>
                    <a href="#">
                        <li class="mb-4">
                            <div class="download">
                                <i class="fa-brands fa-google-play fa-xl"></i>
                                Scarica da google play(da finire)
                            </div>
                        </li>
                    </a>
                    <a href="#">
                        <li class="mb-4">TERMINI E CONDIZIONI</li>
                    </a>
                    <a href="#">
                        <li class="mb-4">POLITICA SULLA PRIVACY</li>
                    </a>
                    <a href="#">
                        <li class="mb-4">POLITICA SUI COOKIE</li>
                    </a>
                    <a href="#">
                        <li class="mb-4">CONFORMITÀ</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</footer> --}}

@endsection
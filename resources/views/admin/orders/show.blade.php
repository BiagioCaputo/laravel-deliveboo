{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Ordine n.{{ $order->id }}')

{{-- Contenuto principale pagina --}}
@section('content')

    <div class="background-container" style="background-image: url('{{ $restaurant->printImage() }}' ); filter: blur(5px);"></div>

    <div class="container">
        <div class="clearfix">
            <div class="card card-deliveboo">

                <h1 class="mb-5">ID Ordine: {{ $order->id }}</h1>
                <ul class="list-unstyled">
                    <li><strong>Nome Cliente: </strong>{{ $order->customer_name }}</li>
                    <li><strong>Indirizzo cliente: </strong>{{ $order->customer_address }}</li>
                    <li><strong>Email cliente: </strong>{{ $order->customer_email }}</li>
                    <li><strong>Telefono Cliente: </strong>{{ $order->customer_phone }}</li>
                    <li><strong>Totale: </strong>{{ $order->total_price }}</li>
                    <li><strong>Pagato: </strong>{{ $order->status ? 'Sì' : 'No' }}</li>
                </ul>
                <p><strong>Piatti ordinati:</strong>
                    @forelse($order->dishes as $dish)
                    <span class="me-3">{{ $dish->name }}</span>
                    @empty
                    Nessun piatto
                    @endforelse
                </p>
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <div>
                        <div class="me-2"><strong>Ordinato il: </strong>{{ $order->getFormattedDate('created_at') }}
                        </div>
                    </div>
                </div>

                <footer>
                    <div class="d-flex justify-content-end align-items-center">
                        <div>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-utensils me-2"></i>Ordini</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection




{{-- Scripts --}}
@section('scripts')
@endsection


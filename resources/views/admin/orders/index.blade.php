{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Ordini')

{{-- Contenuto principale pagina --}}
@section('content')

    <header class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h1 class="text-center">Lista Ordini</h1>
            <a href="{{ route('admin.orders.statistics') }}" class="btn btn-primary"><i class="fa-solid fa-chart-line"></i></a>
        </div>
    </header>

    <div class="container py-2">

        {{-- Lista degli ordini --}}
        <div class="card card-deliveboo table-order my-4 position-static">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">Id ordine</th>
                        <th scope="col" class="order-768">Nome cliente</th>
                        <th scope="col" class="order-992">Indirizzo cliente</th>
                        <th scope="col" class="order-992">Email cliente</th>
                        <th scope="col" class="order-768">Telefono cliente</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Pagato</th>
                        <th scope="col">Data ordine</th>
                        <th scope="col" class="text-center">Dettagli</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td class="order-768">{{ $order->customer_name }}
                            </td>
                            <td class="order-992">{{ $order->customer_address }}</td>
                            <td class="order-992">{{ $order->customer_email }}</td>
                            <td class="order-768">{{ $order->customer_phone }}</td>
                            <td>€{{ $order->total_price }}</td>
                            <td class="text-center">{{ $order->status ? 'Sì' : 'No' }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary"><i
                                            class="fas fa-eye "></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h3 class="text-center my-2">Nessun Ordine effettuato</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())
            {{ $orders->links() }}
        @endif
    </div>

@endsection


{{-- Scripts --}}
@section('scripts')

@endsection

{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Statistiche')

{{-- Contenuto principale pagina --}}
@section('content')
<div class="container">

    <h1 class="text-center my-5">Statistiche Ordini</h1>

    <div class="statistics-container">

        {{-- Grafico mensile --}}
        <canvas id="monthlyOrdersChart"></canvas>

        {{-- Grafico annuale --}}
        <canvas id="annualOrdersChart"></canvas>

    </div>
</div>

@endsection




{{-- Scripts --}}
@section('scripts')


<script>
    //Trasformo in jason gli array ordini mensili e annuali che mi arrivano dal controller
    const monthlyData = @json($monthlyOrders);
    const annualData = @json($annualOrders);

    // Funzione per ottenere il nome completo del mese da un numero
    function getMonthName(monthNumber) {
        const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
        return months[monthNumber - 1]; // I mesi in JavaScript partono da 0, quindi sottraiamo 1
    }

    // Array di tutti i nomi dei mesi
    const allMonths = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    // Ricavo i dati necessari per la tabella dei mesi
    const monthlyLabels = monthlyData.map(item => getMonthName(item.month));
    // Inizializzo il futuro array degli ordini per mese
    let monthlyTotals = [];
    // Itera su tutti i mesi e inserisci il totale corrispondente se presente nei dati, altrimenti inserisci 0
    for (let i = 0; i <= 12; i++) {
        //Se trovo un ordine salvo il totale nel mese corrispondente, altrimenti salvo 0
        const order = monthlyData.find(item => item.month === i);
        monthlyTotals.push(order ? order.total : 0);
    }

    //Grafico per mesi
    const monthlyOrdersChart = new Chart(document.getElementById('monthlyOrdersChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: allMonths,
            datasets: [{
                label: 'Ordini per Mese',
                data: monthlyTotals,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    //Ricavo i dati necessari per la tabella degli anni
    const annualLabels = annualData.map(item => item.year);
    const annualTotals = annualData.map(item => item.total);

    //Grafico per anni
    const annualOrdersChart = new Chart(document.getElementById('annualOrdersChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: annualLabels,
            datasets: [{
                label: 'Ordini per Anno',
                data: annualTotals,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
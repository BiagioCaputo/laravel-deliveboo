{{-- Layout --}}
@extends('layouts.app')

{{-- Titolo --}}
@section('title', 'Statistiche')

{{-- Contenuto principale pagina --}}
@section('content')
    <h1 class="text-center my-5">Statistiche Ordini</h1>

    <div class="statistics-container d-flex">

        {{-- Grafico mensile --}}
        <canvas id="monthlyOrdersChart" width="500" height="200"></canvas>

        {{-- Grafico annuale --}}
        <canvas id="annualOrdersChart" width="500" height="200"></canvas>
    
        
         
    </div>
@endsection




{{-- Scripts --}}
@section('scripts')


<script>
    const monthlyData = @json($monthlyOrders);
        const annualData = @json($annualOrders);

        const monthlyLabels = monthlyData.map(item => item.month);
        const monthlyTotals = monthlyData.map(item => item.total);

        const annualLabels = annualData.map(item => item.year);
        const annualTotals = annualData.map(item => item.total);

        const monthlyOrdersChart = new Chart(document.getElementById('monthlyOrdersChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Ordini Mensili',
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

        const annualOrdersChart = new Chart(document.getElementById('annualOrdersChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: annualLabels,
                datasets: [{
                    label: 'Ordini Annuali',
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


@extends('dashboard')

@section('title', 'Dashboard2')

 <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

@section('content')

<div class="container-fluid mt-4">
    <div class="row justify-content-center">

        <div class="card bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Clientes</h5>
                <p class="card-text display-4">150</p>
            </div>
            <div class="card-footer">
                <span>Actualizado: Hoy</span>
            </div>
        </div>

        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title">Servicios Activos</h5>
                <p class="card-text display-4">85</p>
            </div>
            <div class="card-footer">
                <span>Actualizado: Hoy</span>
            </div>
        </div>

        <div class="card bg-danger">
            <div class="card-body">
                <h5 class="card-title">Tickets Pendientes</h5>
                <p class="card-text display-4">12</p>
            </div>
            <div class="card-footer">
                <span>Actualizado: Hoy</span>
            </div>
        </div>

        <div class="card bg-warning">
            <div class="card-body">
                <h5 class="card-title">Ingresos del Mes</h5>
                <p class="card-text display-4">S/12,500</p>
            </div>
            <div class="card-footer">
                <span>Actualizado: Hoy</span>
            </div>
        </div>
    </div>

    <!-- Gráfico centrado -->
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="chart-container">
                <h5 class="card-title text-center">Visión General</h5>
                <canvas id="myChart"></canvas> <!-- Gráfico de Chart.js -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [{
                    label: 'Clientes Registrados',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }, {
                    label: 'Ingresos',
                    data: [5000, 7000, 3000, 8000, 6000, 12000],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2
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


 


@extends('template.administrador')

@section('title', 'Dashboard')
@section('name_section', 'Dashboard')
@section('description', 'Resumen general y estadísticas del sistema')
@section('item_section', 'Inicio')
@section('section', 'Dashboard')

@section('content')
<!-- Tarjetas de Resumen (KPIs) -->
<div class="row g-3 mt-2 mb-4">
    <div class="col-md-3">
        <div class="card border-0 border-start border-4 border-primary shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Ingresos Totales</h6>
                <h3 class="fw-bold mb-0 text-primary">S/ {{ number_format($totalIncome, 2) }}</h3>
                <small class="text-muted">En {{ $totalSales }} ventas</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 border-start border-4 border-success shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Medicamentos</h6>
                <h3 class="fw-bold mb-0 text-success">{{ $totalMedicines }}</h3>
                <small class="text-muted">En catálogo</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 border-start border-4 border-warning shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Clientes</h6>
                <h3 class="fw-bold mb-0 text-warning">{{ $totalCustomers }}</h3>
                <small class="text-muted">Registrados</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 border-start border-4 border-info shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Categorías</h6>
                <h3 class="fw-bold mb-0 text-info">{{ $totalCategories }}</h3>
                <small class="text-muted">Registradas</small>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="row g-3 mb-4">
    <!-- Gráfico de Ventas por Día -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0">Tendencia de Ventas (Últimos 7 días)</h6>
            </div>
            <div class="card-body">
                <canvas id="salesChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Gráfico de Ventas por Categoría -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0">Ingresos por Categoría</h6>
            </div>
            <div class="card-body d-flex justify-content-center">
                <canvas id="categoryChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Top 5 Medicamentos -->
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0">Top 5 Medicamentos Más Vendidos (Unidades)</h6>
            </div>
            <div class="card-body">
                <canvas id="medicinesChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Importamos Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 1. Gráfico de Líneas (Ventas por día)
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Ventas (S/)',
                data: @json($totalsByDay),
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // 2. Gráfico de Dona (Ventas por categoría)
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: @json($categoryNames),
            datasets: [{
                data: @json($categoryTotals),
                backgroundColor: ['#dc3545', '#0d6efd', '#198754', '#ffc107', '#6c757d']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // 3. Gráfico de Barras (Top medicamentos)
    const ctxMedicines = document.getElementById('medicinesChart').getContext('2d');
    new Chart(ctxMedicines, {
        type: 'bar',
        data: {
            labels: @json($medNames),
            datasets: [{
                label: 'Unidades vendidas',
                data: @json($medTotals),
                backgroundColor: '#0d6efd',
                borderRadius: 5
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush
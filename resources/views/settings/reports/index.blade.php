@extends('template.administrador')

@section('title', 'Reportes')
@section('name_section', 'REPORTES')
@section('description', 'Ventas por rango de fechas y filtros')
@section('item_section', 'Inicio')
@section('section', 'Reportes')
@section('module', 'Principal')

@section('content')
<!-- Filtros -->
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4 mb-4">
    <div class="card-body">
        <form action="{{ route('reports.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-2">
                <label class="form-label text-muted fw-bold" style="font-size: 0.75rem;">Desde</label>
                <input type="date" name="from" class="form-control form-control-sm" value="{{ request('from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted fw-bold" style="font-size: 0.75rem;">Hasta</label>
                <input type="date" name="to" class="form-control form-control-sm" value="{{ request('to') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted fw-bold" style="font-size: 0.75rem;">Cliente</label>
                <select name="customer_id" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" {{ request('customer_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted fw-bold" style="font-size: 0.75rem;">Vendedor</label>
                <select name="user_id" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted fw-bold" style="font-size: 0.75rem;">Categoría</label>
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Todas</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-danger w-100 fw-bold">Filtrar</button>
                <a href="{{ route('reports.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Tarjetas de resumen -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">N° de ventas</h6>
                <h3 class="fw-bold mb-0">{{ $totalSales }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">Total vendido</h6>
                <h3 class="fw-bold mb-0">S/ {{ number_format($totalIncome, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">IGV</h6>
                <h3 class="fw-bold mb-0">S/ {{ number_format($totalIgv, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem;">Venta promedio</h6>
                <h3 class="fw-bold mb-0">S/ {{ number_format($averageSale, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de Barras -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white py-2">
        <h6 class="fw-bold mb-0" style="font-size: 0.85rem;">Total vendido por día (S/)</h6>
    </div>
    <div class="card-body">
        <canvas id="reportBarChart" style="max-height: 200px;"></canvas>
    </div>
</div>

<!-- Tabla -->
<div class="card shadow-sm border-0 border-top border-4 border-dark">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.75rem;">
            <thead class="bg-light text-uppercase text-muted">
                <tr>
                    <th class="py-2">N°</th>
                    <th class="py-2">Fecha</th>
                    <th class="py-2">Cliente</th>
                    <th class="py-2">Vendedor</th>
                    <th class="py-2">Categoría</th>
                    <th class="py-2 text-end">IGV</th>
                    <th class="py-2 text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                <tr>
                    <td>{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $sale->date->format('d/m/Y H:i') }}</td>
                    <td>{{ $sale->customer->name ?? '—' }}</td>
                    <td>{{ $sale->user->name ?? '—' }}</td>
                    <td>{{ $sale->details->first()->medicine->category->name ?? '—' }}</td>
                    <td class="text-end">S/ {{ number_format($sale->igv, 2) }}</td>
                    <td class="text-end fw-bold text-danger">S/ {{ number_format($sale->total, 2) }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No hay ventas registradas en este período.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reportBarChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Total vendido (S/)',
                data: @json($totalsByDay),
                backgroundColor: '#dc3545',
                borderRadius: 4,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush
@extends('template.administrador')
@section('title', 'Ventas')
@section('name_section', 'VENTAS')
@section('description', 'Historial de ventas de la farmacia')
@section('item_section', 'Inicio')
@section('section', 'Ventas')
@section('module', 'Gestión')
@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <a href="{{ route('sales.create') }}" class="btn btn-sm btn-danger text-uppercase fw-bold" style="font-size: 0.75rem;">
            <i class="bi bi-cart-plus"></i> Nueva Venta
        </a>
    </div>
    <div class="table-responsive">
        <div class="px-3 pt-3 pb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">
            Total de ventas: {{ $sales->count() }}
        </div>
        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="bg-white text-uppercase text-muted" style="font-size: 0.75rem; border-bottom: 2px solid #dee2e6;">
                <tr>
                    <th class="text-center py-3">N° Venta</th>
                    <th class="py-3">Fecha</th>
                    <th class="py-3">Cliente</th>
                    <th class="py-3">Vendedor</th>
                    <th class="text-center py-3">Total (S/)</th>
                    <th class="text-center py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <td class="text-center fw-bold">#{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $sale->date->format('d/m/Y H:i') }}</td>
                    <td>{{ $sale->customer->name ?? 'Cliente eliminado' }}</td>
                    <td>{{ $sale->user->name ?? 'Usuario eliminado' }}</td>
                    <td class="text-center fw-bold text-success">S/ {{ number_format($sale->total, 2) }}</td>
                    <td class="text-center">
                        
                        <!-- BOTÓN EDITAR (NUEVO) -->
                        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-outline-primary me-1" title="Editar Venta">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- BOTÓN ANULAR -->
                        <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de anular esta venta? El stock no se devolverá automáticamente.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Anular Venta">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
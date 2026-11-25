@extends('template.administrador')

@section('title', 'Editar Venta')
@section('name_section', 'EDITAR VENTA')
@section('description', 'Modificar los datos de la venta')
@section('item_section', 'Inicio')
@section('section', 'Ventas')
@section('module', 'Editar Venta')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 800px;">
    <form action="{{ route('sales.update', $sale) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="form-label fw-bold">Cliente</label>
            <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ (old('customer_id', $sale->customer_id) == $customer->id) ? 'selected' : '' }}>
                        {{ $customer->name }} (DNI: {{ $customer->dni }})
                    </option>
                @endforeach
            </select>
            @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="bg-light p-3 rounded mb-4 border">
            <h6 class="fw-bold mb-3 text-uppercase text-muted" style="font-size: 0.8rem;">Producto</h6>
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medicamento</label>
                    <select name="medicine_id" class="form-select @error('medicine_id') is-invalid @enderror">
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}" {{ (old('medicine_id', $detail->medicine_id ?? '') == $medicine->id) ? 'selected' : '' }}>
                                {{ $medicine->name }} - S/ {{ number_format($medicine->price, 2) }} (Stock: {{ $medicine->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('medicine_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="amount" value="{{ old('amount', $detail->amount ?? 1) }}" min="1" class="form-control @error('amount') is-invalid @enderror">
                    @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
            <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Actualizar Venta</button>
        </div>
    </form>
</div>
@endsection
@extends('template.administrador')

@section('title', 'Nueva Venta')
@section('name_section', 'NUEVA VENTA')
@section('description', 'Registrar una venta')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4">
    <form action="{{ route('sales.store') }}" method="POST" class="card-body" id="saleForm">
        @csrf
        
        <div class="row mb-4">
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold text-muted small">Cliente</label>
                <select name="customer_id" class="form-select border-secondary" required>
                    <option value="">Seleccione...</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label fw-bold text-muted small">Vendedor</label>
                <input type="text" class="form-control bg-light border-secondary" value="{{ auth()->user()->name }}" readonly>
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered align-middle text-center" style="font-size: 0.85rem;">
                <thead class="bg-light text-muted text-uppercase">
                    <tr>
                        <th class="text-start ps-3" style="width: 45%;">Medicamentos</th>
                        <th style="width: 15%;">Cantidad</th>
                        <th style="width: 15%;">Precio</th>
                        <th style="width: 20%;">Subtotal</th>
                        <th style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody id="itemsTableBody">
                    <!-- Fila dinámica -->
                </tbody>
            </table>
        </div>

        <button type="button" class="btn btn-sm btn-outline-danger border" id="addItemBtn">
            <i class="bi bi-plus-lg"></i> Agregar medicamento
        </button>

        <div class="d-flex justify-content-between align-items-center mt-5">
            <div class="fw-bold fs-5">
                Total (incluye IGV) <span class="ms-2" id="grandTotal">S/ 0.00</span>
            </div>
            <div>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                <button type="submit" class="btn btn-danger fw-bold px-4 ms-2">Registrar venta</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    let rowCount = 0;
    // Creamos las opciones del select con los datos de PHP
    const medOptions = `
        <option value="">Seleccione...</option>
        @foreach($medicines as $med)
            <option value="{{ $med->id }}" data-price="{{ $med->price }}" data-stock="{{ $med->stock }}">{{ $med->name }} (Stock: {{ $med->stock }})</option>
        @endforeach
    `;

    function addRow() {
        const tbody = document.getElementById('itemsTableBody');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="text-start ps-3">
                <select name="items[${rowCount}][medicine_id]" class="form-select form-select-sm border-secondary med-select" required>
                    ${medOptions}
                </select>
            </td>
            <td>
                <input type="number" name="items[${rowCount}][amount]" class="form-control form-control-sm text-center border-secondary amt-input" value="1" min="1" required>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm bg-light text-end border-secondary price-view" value="S/ 0.00" readonly>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm bg-light text-end border-secondary sub-view" value="S/ 0.00" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-link text-danger remove-btn"><i class="bi bi-trash"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
        rowCount++;
        calculateTotal();
    }

    // Calcular subtotales y total general
    function calculateTotal() {
        let grandTotal = 0;
        document.querySelectorAll('#itemsTableBody tr').forEach(tr => {
            const select = tr.querySelector('.med-select');
            const amount = parseFloat(tr.querySelector('.amt-input').value) || 0;
            const price = parseFloat(select.options[select.selectedIndex]?.dataset.price) || 0;
            
            const subtotal = price * amount;
            grandTotal += subtotal;

            tr.querySelector('.price-view').value = `S/ ${price.toFixed(2)}`;
            tr.querySelector('.sub-view').value = `S/ ${subtotal.toFixed(2)}`;
        });
        document.getElementById('grandTotal').innerText = `S/ ${grandTotal.toFixed(2)}`;
    }

    // Eventos
    document.getElementById('addItemBtn').addEventListener('click', addRow);
    
    document.getElementById('itemsTableBody').addEventListener('input', function(e) {
        if (e.target.matches('.amt-input')) calculateTotal();
    });

    document.getElementById('itemsTableBody').addEventListener('change', function(e) {
        if (e.target.matches('.med-select')) calculateTotal();
    });

    document.getElementById('itemsTableBody').addEventListener('click', function(e) {
        if (e.target.closest('.remove-btn')) {
            e.target.closest('tr').remove();
            calculateTotal();
        }
    });

    // Agregamos la primera fila al cargar la página
    document.addEventListener('DOMContentLoaded', addRow);
</script>
@endpush
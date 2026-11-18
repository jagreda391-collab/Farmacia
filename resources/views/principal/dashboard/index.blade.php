@extends('template.administrador')

@section('title', 'Dashboard')
@section('name_section', 'Dashboard')
@section('description', 'Resumen general del sistema')
@section('item_section', 'Inicio')
@section('section', 'Dashboard')

@section('content')
<div class="row g-3 mt-2">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Medicamentos</h6>
                <h3 class="fw-bold mb-0">0</h3>
                <small class="text-muted">Registrados en el sistema</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Clientes</h6>
                <h3 class="fw-bold mb-0">0</h3>
                <small class="text-muted">Registrados en el sistema</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted text-uppercase fw-bold mb-2">Categorías</h6>
                <h3 class="fw-bold mb-0">{{ \App\Models\Category::count() }}</h3>
                <small class="text-muted">Registradas en el sistema</small>
            </div>
        </div>
    </div>
</div>
@endsection
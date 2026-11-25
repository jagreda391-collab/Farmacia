@extends('template.administrador')
@section('title', 'Editar Proveedor')
@section('name_section', 'EDITAR PROVEEDOR')
@section('description', 'Modificar datos del proveedor')
@section('item_section', 'Inicio')
@section('section', 'Proveedores')
@section('module', 'Editar Proveedor')
@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 640px;">
    <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.suppliers.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Actualizar</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
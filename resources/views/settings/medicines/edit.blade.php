@extends('template.administrador')
@section('title', 'Editar Medicamento')
@section('name_section', 'EDITAR MEDICAMENTO')
@section('description', 'Modificar datos del medicamento')
@section('item_section', 'Inicio')
@section('section', 'Medicamentos')
@section('module', 'Editar Medicamento')
@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 640px;">
    <form action="{{ route('medicines.update', $medicine) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.medicines.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Actualizar</button>
        <a href="{{ route('medicines.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
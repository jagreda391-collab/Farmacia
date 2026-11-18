@extends('template.administrador')

@section('title', 'Nuevo Cliente')
@section('name_section', 'NUEVO CLIENTE')
@section('description', 'Registrar un nuevo cliente')
@section('item_section', 'Inicio')
@section('section', 'Clientes')
@section('module', 'Nuevo Cliente')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 640px;">
    <form action="{{ route('customers.store') }}" method="POST" class="card-body">
        @csrf
        @include('settings.customers.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Guardar</button>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
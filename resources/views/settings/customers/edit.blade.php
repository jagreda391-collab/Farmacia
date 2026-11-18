@extends('template.administrador')

@section('title', 'Editar Cliente')
@section('name_section', 'EDITAR CLIENTE')
@section('description', 'Modificar datos del cliente')
@section('item_section', 'Inicio')
@section('section', 'Clientes')
@section('module', 'Editar Cliente')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 640px;">
    <form action="{{ route('customers.update', $customer) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.customers.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Actualizar</button>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
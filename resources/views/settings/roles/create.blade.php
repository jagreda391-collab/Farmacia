@extends('template.administrador')

@section('title', 'Nuevo Rol')
@section('name_section', 'Nuevo Rol')
@section('description', 'Registrar un nuevo rol en el sistema')
@section('item_section', 'Inicio')
@section('section', 'Configuraciones')
@section('module', 'Nuevo Rol')

@section('content')
<div class="card shadow-sm border-5 border-top border-secondary mt-4" style="max-width: 640px;">
    <form action="{{ route('roles.store') }}" method="POST" class="card-body">
        @csrf
        @include('settings.roles.form')
        <button type="submit" class="btn btn-danger">Guardar</button>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>
@endsection
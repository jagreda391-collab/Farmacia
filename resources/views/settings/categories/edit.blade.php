@extends('template.administrador')

@section('title', 'Editar Rol')
@section('name_section', 'Editar Rol')
@section('description', 'Modificar los datos del rol')
@section('item_section', 'Inicio')
@section('section', 'Configuraciones')
@section('module', 'Editar Rol')

@section('content')
<div class="card shadow-sm border-5 border-top border-secondary mt-4" style="max-width: 640px;">
    <form action="{{ route('roles.update', $role) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.roles.form')
        <button type="submit" class="btn btn-danger">Actualizar</button>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>
@endsection
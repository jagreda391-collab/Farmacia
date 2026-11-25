@extends('template.administrador')
@section('title', 'Nuevo Usuario')
@section('name_section', 'NUEVO USUARIO')
@section('description', 'Registrar un nuevo usuario en el sistema')
@section('item_section', 'Inicio')
@section('section', 'Usuarios')
@section('module', 'Nuevo Usuario')
@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 800px;">
    <form action="{{ route('users.store') }}" method="POST" class="card-body">
        @csrf
        @include('settings.users.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Guardar</button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
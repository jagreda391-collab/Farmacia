@extends('template.administrador')
@section('title', 'Editar Usuario')
@section('name_section', 'EDITAR USUARIO')
@section('description', 'Modificar datos del usuario')
@section('item_section', 'Inicio')
@section('section', 'Usuarios')
@section('module', 'Editar Usuario')
@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 800px;">
    <form action="{{ route('users.update', $user) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.users.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Actualizar</button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
@extends('template.administrador')
@section('title', 'Editar categoría')
@section('name_section', 'Editar categoría')
@section('description', 'Modificar los datos de la categoría')
@section('item_section', 'Inicio')
@section('section', 'Categorías')
@section('module', 'Editar categoría')

@section('content')
<div class="card border-0 shadow-sm mt-4" style="max-width: 640px;">
    <form action="{{ route('categories.update', $category) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.categories.form')
        <button type="submit" class="btn btn-danger">Actualizar</button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>
@endsection
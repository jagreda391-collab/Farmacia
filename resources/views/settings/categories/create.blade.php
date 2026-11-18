@extends('template.administrador')
@section('title', 'Nueva categoría')
@section('name_section', 'Nueva categoría')
@section('description', 'Registrar una nueva categoría')
@section('item_section', 'Inicio')
@section('section', 'Categorías')
@section('module', 'Nueva categoría')

@section('content')
<div class="card border-0 shadow-sm mt-4" style="max-width: 640px;">
    <form action="{{ route('categories.store') }}" method="POST" class="card-body">
        @csrf
        @include('settings.categories.form')
        <button type="submit" class="btn btn-danger">Guardar</button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>
@endsection
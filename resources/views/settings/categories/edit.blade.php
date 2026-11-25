@extends('template.administrador')

@section('title', 'Editar Categoría')
@section('name_section', 'EDITAR CATEGORÍA')
@section('description', 'Modificar datos de la categoría')
@section('item_section', 'Inicio')
@section('section', 'Categorías')
@section('module', 'Editar Categoría')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 640px;">
    <form action="{{ route('categories.update', $category) }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        @include('settings.categories.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Actualizar</button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
@extends('template.administrador')

@section('title', 'Nueva Categoría')
@section('name_section', 'NUEVA CATEGORÍA')
@section('description', 'Registrar una nueva categoría de medicamentos')
@section('item_section', 'Inicio')
@section('section', 'Categorías')
@section('module', 'Nueva Categoría')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4" style="max-width: 640px;">
    <form action="{{ route('categories.store') }}" method="POST" class="card-body">
        @csrf
        @include('settings.categories.form')
        <button type="submit" class="btn btn-danger text-uppercase fw-bold" style="font-size: 0.8rem;">Guardar</button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Cancelar</a>
    </form>
</div>
@endsection
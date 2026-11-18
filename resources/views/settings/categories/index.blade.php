@extends('template.administrador')

@section('title', 'Categorías')
@section('name_section', 'Categorías')
@section('description', 'Listado de categorías')
@section('item_section', 'Inicio')
@section('section', 'Configuraciones')
@section('module', 'Categorías')

@section('content')
<div class="card shadow-sm border-5 border-top border-secondary mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h2 class="h6 fw-bold mb-0">Listado de categorías</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-danger">
            <i class="bi bi-plus-lg"></i> Nueva categoría
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover w-100 align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="text-center">N.°</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-center">Medicamentos</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td class="text-start align-middle">{{ $category->name }}</td>
                    <td class="text-start align-middle">{{ $category->description ?? '—' }}</td>
                    <td class="text-center align-middle">{{ $category->medicines_count }}</td>
                    <td class="text-center align-middle">
                        <!-- Dropdown de 3 puntitos -->
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a class="dropdown-item" href="{{ route('categories.edit', $category) }}">
                                        <i class="bi bi-pencil me-2"></i>Editar
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-trash me-2"></i>Eliminar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary py-4">No hay categorías registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
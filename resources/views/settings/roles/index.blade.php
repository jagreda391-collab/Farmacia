@extends('template.administrador')

@section('title', 'Roles')
@section('name_section', 'ROLES')
@section('description', 'Listado de roles')
@section('item_section', 'Inicio')
@section('section', 'Roles')
@section('module', 'Configuraciones')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4">
    
    <!-- Botón superior -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-danger text-uppercase fw-bold" style="font-size: 0.75rem;">
            <i class="bi bi-plus-lg"></i> Nuevo registro
        </a>
    </div>

    <div class="table-responsive">
        <!-- Contador de registros -->
        <div class="px-3 pt-3 pb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">
            Total de registros encontrados: {{ $roles->count() }}
        </div>

        <!-- Tabla con estilo exacto del profesor -->
        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="bg-white text-uppercase text-muted" style="font-size: 0.75rem; border-bottom: 2px solid #dee2e6;">
                <tr>
                    <th class="text-center py-3" style="width: 5%;">N°</th>
                    <th class="py-3" style="width: 25%;">Nombre</th>
                    <th class="py-3" style="width: 50%;">Descripción</th>
                    <th class="text-center py-3" style="width: 20%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description ?? '—' }}</td>
                    <td class="text-center">
                        
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a class="dropdown-item" href="{{ route('roles.edit', $role) }}">
                                        <i class="bi bi-pencil me-2"></i>Editar
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este rol?')">
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
                    <td colspan="4" class="text-center text-secondary py-4">No hay roles registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
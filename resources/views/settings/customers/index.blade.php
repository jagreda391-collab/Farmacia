@extends('template.administrador')

@section('title', 'Clientes')
@section('name_section', 'CLIENTES')
@section('description', 'Listado de clientes')
@section('item_section', 'Inicio')
@section('section', 'Clientes')
@section('module', 'Gestión')

@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4">
    
    <!-- Botón superior -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <a href="{{ route('customers.create') }}" class="btn btn-sm btn-danger text-uppercase fw-bold" style="font-size: 0.75rem;">
            <i class="bi bi-plus-lg"></i> Nuevo registro
        </a>
    </div>

    <div class="table-responsive">
        <!-- Contador de registros -->
        <div class="px-3 pt-3 pb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">
            Total de registros encontrados: {{ $customers->count() }}
        </div>

        <!-- Tabla -->
        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="bg-white text-uppercase text-muted" style="font-size: 0.75rem; border-bottom: 2px solid #dee2e6;">
                <tr>
                    <th class="text-center py-3" style="width: 5%;">N°</th>
                    <th class="py-3" style="width: 30%;">Nombre</th>
                    <th class="py-3" style="width: 15%;">DNI</th>
                    <th class="py-3" style="width: 15%;">Teléfono</th>
                    <th class="text-center py-3" style="width: 15%;">Edad</th>
                    <th class="text-center py-3" style="width: 20%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->dni }}</td>
                    <td>{{ $customer->phone ?? '—' }}</td>
                    <td class="text-center">{{ $customer->age ?? '—' }}</td>
                    <td class="text-center">
                        
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a class="dropdown-item" href="{{ route('customers.edit', $customer) }}">
                                        <i class="bi bi-pencil me-2"></i>Editar
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
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
                    <td colspan="6" class="text-center text-secondary py-4">No hay clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
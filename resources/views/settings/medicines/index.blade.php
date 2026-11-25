@extends('template.administrador')
@section('title', 'Medicamentos')
@section('name_section', 'MEDICAMENTOS')
@section('description', 'Listado de medicamentos')
@section('item_section', 'Inicio')
@section('section', 'Medicamentos')
@section('module', 'Gestión')
@section('content')
<div class="card shadow-sm border-0 border-top border-4 border-dark mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <a href="{{ route('medicines.create') }}" class="btn btn-sm btn-danger text-uppercase fw-bold" style="font-size: 0.75rem;">
            <i class="bi bi-plus-lg"></i> Nuevo registro
        </a>
    </div>
    <div class="table-responsive">
        <div class="px-3 pt-3 pb-2 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">
            Total de registros encontrados: {{ $medicines->count() }}
        </div>
        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
            <thead class="bg-white text-uppercase text-muted" style="font-size: 0.75rem; border-bottom: 2px solid #dee2e6;">
                <tr>
                    <th class="text-center py-3" style="width: 5%;">N°</th>
                    <th class="py-3" style="width: 30%;">Nombre</th>
                    <th class="py-3" style="width: 20%;">Categoría</th>
                    <th class="text-center py-3" style="width: 15%;">Precio</th>
                    <th class="text-center py-3" style="width: 10%;">Stock</th>
                    <th class="text-center py-3" style="width: 20%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->category->name }}</td>
                    <td class="text-center">S/ {{ number_format($medicine->price, 2) }}</td>
                    <td class="text-center">{{ $medicine->stock }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="{{ route('medicines.edit', $medicine) }}"><i class="bi bi-pencil me-2"></i>Editar</a></li>
                                <li>
                                    <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este medicamento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
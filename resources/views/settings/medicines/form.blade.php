<div class="mb-3">
    <label class="form-label">Categoría</label>
    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">Seleccione una categoría...</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (old('category_id', $medicine->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    
    <!-- AQUÍ ESTÁ EL AVISO ROJO -->
    @if($categories->isEmpty())
        <small class="text-danger mt-2 d-block fw-bold">
            <i class="bi bi-exclamation-triangle-fill"></i> No hay categorías. <a href="{{ route('categories.create') }}" class="text-danger text-decoration-underline">Crea una primero</a>.
        </small>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Nombre del Medicamento</label>
    <input type="text" name="name" value="{{ old('name', $medicine->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Ej: Paracetamol 500mg">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Precio (S/)</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $medicine->price ?? '') }}" class="form-control @error('price') is-invalid @enderror" placeholder="0.00">
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $medicine->stock ?? '') }}" class="form-control @error('stock') is-invalid @enderror" placeholder="Ej: 100">
        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
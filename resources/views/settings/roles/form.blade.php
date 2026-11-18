<div class="mb-3">
    <label for="name" class="form-label">Nombre del Rol</label>
    <input type="text" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" 
           class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descripción (opcional)</label>
    <textarea id="description" name="description" rows="3" 
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $role->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
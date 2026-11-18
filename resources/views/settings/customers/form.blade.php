<div class="mb-3">
    <label for="name" class="form-label">Nombre Completo</label>
    <input type="text" id="name" name="name" value="{{ old('name', $customer->name ?? '') }}" 
           class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="dni" class="form-label">DNI</label>
    <input type="text" id="dni" name="dni" value="{{ old('dni', $customer->dni ?? '') }}" 
           class="form-control @error('dni') is-invalid @enderror">
    @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Teléfono (opcional)</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" 
           class="form-control @error('phone') is-invalid @enderror">
    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="age" class="form-label">Edad (opcional)</label>
    <input type="number" id="age" name="age" value="{{ old('age', $customer->age ?? '') }}" 
           class="form-control @error('age') is-invalid @enderror">
    @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
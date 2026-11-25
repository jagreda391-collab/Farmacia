<div class="mb-3">
    <label class="form-label fw-bold text-muted small">Razón Social</label>
    <input type="text" name="business_name" value="{{ old('business_name', $supplier->business_name ?? '') }}" class="form-control @error('business_name') is-invalid @enderror" placeholder="Ej: Distribuidora Farma Perú S.A.C.">
    @error('business_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold text-muted small">RUC</label>
        <input type="text" name="ruc" value="{{ old('ruc', $supplier->ruc ?? '') }}" class="form-control @error('ruc') is-invalid @enderror" placeholder="11 dígitos">
        @error('ruc') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold text-muted small">Teléfono (opcional)</label>
        <input type="text" name="phone" value="{{ old('phone', $supplier->phone ?? '') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Ej: 987654321">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold text-muted small">Correo (opcional)</label>
        <input type="email" name="email" value="{{ old('email', $supplier->email ?? '') }}" class="form-control @error('email') is-invalid @enderror" placeholder="correo@proveedor.com">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold text-muted small">Dirección (opcional)</label>
        <input type="text" name="address" value="{{ old('address', $supplier->address ?? '') }}" class="form-control @error('address') is-invalid @enderror" placeholder="Ej: Av. Los Incas 1250, Lima">
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Nombre Completo</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Ej: Juan Pérez">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">DNI</label>
        <input type="text" name="dni" value="{{ old('dni', $user->dni ?? '') }}" class="form-control @error('dni') is-invalid @enderror" placeholder="8 dígitos">
        @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Teléfono (opcional)</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control @error('email') is-invalid @enderror" placeholder="correo@ejemplo.com">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Rol asignado</label>
        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
            <option value="">Seleccione un rol...</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ (old('role_id', $user->role_id ?? '') == $role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if($roles->isEmpty())
            <small class="text-danger mt-1 d-block"><i class="bi bi-exclamation-triangle-fill"></i> No hay roles. <a href="{{ route('roles.create') }}">Crea uno primero</a>.</small>
        @endif
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Contraseña {{ isset($user) ? '(Dejar en blanco para no cambiar)' : '' }}</label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 6 caracteres">
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
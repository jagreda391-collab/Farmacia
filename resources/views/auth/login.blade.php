<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | FARM SJB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f8; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; padding: 2rem; border-radius: 1rem; }
    </style>
</head>
<body>

<div class="card shadow-lg border-0 login-card">
    <div class="text-center mb-4">
        <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <i class="bi bi-plus-lg fs-2 fw-bold"></i>
        </div>
        <h4 class="fw-bold">FARM SJB</h4>
        <p class="text-muted small">Sistema de Venta de Medicamentos</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label fw-bold small text-muted">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="admin@sanjuan.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label fw-bold small text-muted">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger w-100 fw-bold py-2">INGRESAR AL SISTEMA</button>
    </form>
</div>

</body>
</html>
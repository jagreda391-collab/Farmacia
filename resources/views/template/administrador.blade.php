<!doctype html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | FARM SJB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f8; }
        #app-wrapper { height: 100vh; overflow: hidden; }
        .sidebar-section-title { font-size: .65rem; letter-spacing: .08em; }
        .brand-icon { width: 42px; height: 42px; }
        .user-avatar { width: 36px; height: 36px; font-size: .78rem; }
        #sidebar { width: 260px; min-width: 260px; height: 100vh; overflow: hidden; }
        .sidebar-link { transition: background-color .15s ease, color .15s ease; }
        .sidebar-link:hover { background-color: rgba(255, 255, 255, .08) !important; color: #fff !important; }
        .sidebar-link.active_item { background-color: #dc3545 !important; color: #fff !important; font-weight: 500; }
        .app-header { min-height: 60px; flex-shrink: 0; z-index: 100; }
        .sidebar-user-btn { background: transparent; border: none; color: inherit; }
        .sidebar-user-btn:hover { background-color: rgba(255, 255, 255, .08) !important; }
        .app-content::-webkit-scrollbar { width: 6px; }
        .app-content::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, .12); border-radius: 4px; }
    </style>
</head>
<body>
<div id="app-wrapper" class="d-flex">
    
    <!-- Parcial del Menú Lateral -->
    @include('partials.sidebar')

    <div class="main-wrapper d-flex flex-column flex-grow-1 overflow-hidden">
        
        <!-- Parcial del Encabezado -->
        @include('partials.header')

        <main class="app-content flex-grow-1 overflow-y-auto p-3 p-lg-4">
            <div class="container-fluid p-0">
                
                <!-- Descripción y Migas de Pan -->
                <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row gap-2 mb-4">
                    <p class="text-secondary mb-0">@yield('description')</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item text-muted">@yield('item_section', 'Inicio')</li>
                            <li class="breadcrumb-item text-muted">@yield('section')</li>
                            <li class="breadcrumb-item text-dark fw-medium" aria-current="page">@yield('module')</li>
                        </ol>
                    </nav>
                </div>

                <!-- Mensajes de Éxito y Error -->
                @if(session('ok'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('ok') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Contenido de la Página -->
                @yield('content')
            </div>
        </main>
    </div>
</div>

<!-- Modal de Cierre de Sesión -->
@include('partials.modal-logout')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
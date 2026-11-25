
<aside id="sidebar" class="bg-dark text-white d-flex flex-column flex-shrink-0">
    <div class="d-flex align-items-center px-3 pt-4 pb-3">
        <div class="brand-icon rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-2 flex-shrink-0">
            <i class="bi bi-plus-lg fs-5 fw-bold"></i>
        </div>

        <div class="lh-sm overflow-hidden flex-grow-1">
            <div class="text-white fw-bold fs-5 lh-1">SJB</div>
            <div class="sidebar-section-title text-white-50 fw-normal mt-1">
                Sistema de Venta de Medicamentos
            </div>
        </div>
    </div>

    <hr class="mx-3 my-0" style="border-color:rgba(255,255,255,.1)">

    <nav class="sidebar-nav flex-grow-1 overflow-y-auto py-3 px-2">

        <!-- PRINCIPAL -->
        <p class="sidebar-section-title text-white-50 text-uppercase fw-semibold px-3 mb-2 mt-2">
            Principal
        </p>

        <ul class="nav flex-column gap-1 mb-1">

            <!-- DASHBOARD: Todos -->
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                   class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('/') ? 'active_item' : '' }}">
                    <i class="bi bi-house-door fs-6"></i>
                    <span class="small fw-medium">Dashboard</span>
                </a>
            </li>

            <!-- REPORTES: Administrador y Químico farmacéutico -->
            @if(auth()->user()->hasAnyRole(['Administrador', 'Químico farmacéutico']))
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}"
                       class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('reports*') ? 'active_item' : '' }}">
                        <i class="bi bi-bar-chart fs-6"></i>
                        <span class="small fw-medium">Reportes</span>
                    </a>
                </li>
            @endif

        </ul>

        <!-- GESTIÓN -->
        <p class="sidebar-section-title text-white-50 text-uppercase fw-semibold px-3 mb-2 mt-3">
            Gestión
        </p>

        <ul class="nav flex-column gap-1 mb-1">

            <!-- MEDICAMENTOS: Administrador y Químico farmacéutico -->
            @if(auth()->user()->hasAnyRole(['Administrador', 'Químico farmacéutico']))
                <li class="nav-item">
                    <a href="{{ route('medicines.index') }}"
                       class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('medicines*') ? 'active_item' : '' }}">
                        <i class="bi bi-box-seam fs-6"></i>
                        <span class="small fw-medium">Medicamentos</span>
                    </a>
                </li>
            @endif

            <!-- PROVEEDORES: Solo Administrador -->
            @if(auth()->user()->hasRole('Administrador'))
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}"
                       class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('suppliers*') ? 'active_item' : '' }}">
                        <i class="bi bi-truck fs-6"></i>
                        <span class="small fw-medium">Proveedores</span>
                    </a>
                </li>
            @endif

            <!-- CLIENTES: Todos -->
            <li class="nav-item">
                <a href="{{ route('customers.index') }}"
                   class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('customers*') ? 'active_item' : '' }}">
                    <i class="bi bi-people fs-6"></i>
                    <span class="small fw-medium">Clientes</span>
                </a>
            </li>

            <!-- VENTAS: Todos -->
            <li class="nav-item">
                <a href="{{ route('sales.index') }}"
                   class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('sales*') ? 'active_item' : '' }}">
                    <i class="bi bi-cart3 fs-6"></i>
                    <span class="small fw-medium">Ventas</span>
                </a>
            </li>

        </ul>

        <!-- CONFIGURACIONES: Solo Administrador -->
        @if(auth()->user()->hasRole('Administrador'))

            <p class="sidebar-section-title text-white-50 text-uppercase fw-semibold px-3 mb-2 mt-3">
                Configuraciones
            </p>

            <ul class="nav flex-column gap-1">

                <!-- ROLES -->
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}"
                       class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('roles*') ? 'active_item' : '' }}">
                        <i class="bi bi-shield fs-6"></i>
                        <span class="small fw-medium">Roles</span>
                    </a>
                </li>

                <!-- USUARIOS -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('users*') ? 'active_item' : '' }}">
                        <i class="bi bi-person-gear fs-6"></i>
                        <span class="small fw-medium">Usuarios</span>
                    </a>
                </li>

                <!-- CATEGORÍAS -->
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                       class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('categories*') ? 'active_item' : '' }}">
                        <i class="bi bi-grid fs-6"></i>
                        <span class="small fw-medium">Categorías</span>
                    </a>
                </li>

            </ul>

        @endif

    </nav>

    <!-- PERFIL DE USUARIO Y CERRAR SESIÓN -->
    <div style="border-top:1px solid rgba(255,255,255,.1)">

        <div class="d-flex align-items-center justify-content-between px-3 py-3">

            <div class="d-flex align-items-center gap-2">

                <div class="user-avatar rounded-circle bg-danger d-flex align-items-center justify-content-center flex-shrink-0">
                    <span class="text-white fw-bold lh-1">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </span>
                </div>

                <div class="lh-sm overflow-hidden">
                    <div class="text-white fw-semibold small">
                        {{ auth()->user()->name ?? 'Usuario' }}
                    </div>

                    <div class="text-white-50" style="font-size:.7rem">
                        {{ auth()->user()->email ?? 'correo@ejemplo.com' }}
                    </div>
                </div>

            </div>

            <!-- CERRAR SESIÓN -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="btn btn-sm btn-outline-danger border-0"
                        title="Cerrar Sesión">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </button>
            </form>

        </div>

    </div>

</aside>

<aside id="sidebar" class="bg-dark text-white d-flex flex-column flex-shrink-0">
    <div class="d-flex align-items-center px-3 pt-4 pb-3">
        <div class="brand-icon rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-2 flex-shrink-0">
            <i class="bi bi-plus-lg fs-5 fw-bold"></i>
        </div>
        <div class="lh-sm overflow-hidden flex-grow-1">
            <div class="text-white fw-bold fs-5 lh-1">SJB</div>
            <div class="sidebar-section-title text-white-50 fw-normal mt-1">Sistema de Venta de Medicamentos</div>
        </div>
    </div>
    <hr class="mx-3 my-0" style="border-color:rgba(255,255,255,.1)">
    
    <nav class="sidebar-nav flex-grow-1 overflow-y-auto py-3 px-2">
        <!-- Principal -->
        <p class="sidebar-section-title text-white-50 text-uppercase fw-semibold px-3 mb-2 mt-2">Principal</p>
        <ul class="nav flex-column gap-1 mb-1">
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('/') ? 'active_item' : '' }}">
                    <i class="bi bi-house-door fs-6"></i><span class="small fw-medium">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-bar-chart fs-6"></i><span class="small fw-medium">Reportes</span>
                </a>
            </li>
        </ul>

        <!-- Gestión -->
        <p class="sidebar-section-title text-white-50 text-uppercase fw-semibold px-3 mb-2 mt-3">Gestión</p>
        <ul class="nav flex-column gap-1 mb-1">
            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam fs-6"></i><span class="small fw-medium">Medicamentos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-people fs-6"></i><span class="small fw-medium">Clientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-cart3 fs-6"></i><span class="small fw-medium">Ventas</span>
                </a>
            </li>
        </ul>

        <!-- Configuraciones -->
        <p class="sidebar-section-title text-white-50 text-uppercase fw-semibold px-3 mb-2 mt-3">Configuraciones</p>
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-shield fs-6"></i><span class="small fw-medium">Roles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2">
                    <i class="bi bi-person-gear fs-6"></i><span class="small fw-medium">Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link sidebar-link text-white-50 rounded-4 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('categories*') ? 'active_item' : '' }}">
                    <i class="bi bi-grid fs-6"></i><span class="small fw-medium">Categorías</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Perfil de Usuario -->
    <div style="border-top:1px solid rgba(255,255,255,.1)">
        <button class="btn w-100 d-flex align-items-center gap-2 text-start px-3 py-3 sidebar-user-btn" type="button">
            <div class="user-avatar rounded-circle bg-danger d-flex align-items-center justify-content-center flex-shrink-0">
                <span class="text-white fw-bold lh-1">SJ</span>
            </div>
            <div class="lh-sm overflow-hidden flex-grow-1 text-start">
                <div class="text-white fw-semibold small">Administrador</div>
                <div class="text-white-50" style="font-size:.7rem">admin@sanjuan.com</div>
            </div>
            <i class="bi bi-chevron-up text-white-50 small"></i>
        </button>
    </div>
</aside>
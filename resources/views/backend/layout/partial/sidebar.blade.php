<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('index') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Administración</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.usuario') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.usuario.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar usuario
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Clientes</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('usersList') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de clientes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('addUser') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar cliente
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Proveedores</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('usersList') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de proveedores
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('addUser') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar proveedor
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>

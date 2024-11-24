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
                <a href="{{ route('admin') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Administración</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:user-solid" class="menu-icon"></iconify-icon>
                    <span>Usuarios</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('usuario') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usuario.nuevo') }}">
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
                    <iconify-icon icon="flowbite:building-outline" class="menu-icon"></iconify-icon>
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
            <li class="sidebar-menu-group-title">Contenido</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ant-design:product-filled" class="menu-icon"></iconify-icon>
                    <span>Productos</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('usuario') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usuario.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar usuario
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mdi:cart" class="menu-icon"></iconify-icon>
                    <span>Compras</span>
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
                    <iconify-icon icon="lsicon:sales-return-filled" class="menu-icon"></iconify-icon>
                    <span>Ventas</span>
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
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:graph-bold" class="menu-icon"></iconify-icon>
                    <span>Estadísticas</span>
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

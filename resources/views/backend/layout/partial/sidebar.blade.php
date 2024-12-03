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
            {{-- <li>
                <a href="{{ route('index') }}">
                    <iconify-icon icon="mdi:hospital" class="menu-icon"></iconify-icon>
                    <span>Información</span>
                </a>
            </li> --}}
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
                        <a href="{{ route('cliente') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de clientes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cliente.nuevo') }}">
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
                        <a href="{{ route('proveedor') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de proveedores
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('proveedor.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar proveedor
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-group-title">Contenido</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="material-symbols:category" class="menu-icon"></iconify-icon>
                    <span>Categorías</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('categoria') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de categorías
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categoria.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar categoría
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="ant-design:product-filled" class="menu-icon"></iconify-icon>
                    <span>Productos</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('producto') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('producto.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Agregar producto
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-group-title">Operaciones</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="lsicon:sales-return-filled" class="menu-icon"></iconify-icon>
                    <span>Ventas</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('venta') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de ventas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('venta.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Registrar venta
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
                        <a href="{{ route('compra') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Lista de compras
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('compra.nuevo') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Registrar compra
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
                        <a href="{{ route('estadistica.ventas') }}">
                            <i class="ri-circle-fill circle-icon text-info-main w-auto"></i>
                            Ventas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('estadistica.compras') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Compras
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>

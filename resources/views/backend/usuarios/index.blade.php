@extends('backend.layout.layout')

@php
    $title = 'Usuarios';
    $subTitle = 'Lista de usuarios';
    $script = '<script>
        $(".remove-item-btn").on("click", function() {
            const id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: "<h6>¿Estás seguro de eliminar este usuario?</h6>",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar",
            }).then(function(response) {
                if (response.isConfirmed) {
                    $("#form-eliminar-" + id).submit();
                }
            })
        })
    </script>';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <form method="GET" action="{{ route('usuario') }}" class="d-flex align-items-center flex-wrap gap-3">
                <span class="text-md fw-medium text-secondary-light mb-0">Mostrar</span>
                <select id="recordsPerPage" class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px"
                    name="per_page">
                    
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>

                <div class="navbar-search">
                    <iconify-icon icon="mdi:search" class="icon text-xl line-height-1"></iconify-icon>
                    <input type="text" class="bg-base h-40-px w-auto" name="search" value="{{ request('search') }}"
                        placeholder="Buscar">
                </div>

                <select id="filterStatus" class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px"
                    name="status">
                    <option value="" {{ request('status') == null ? 'selected' : '' }}>ESTADO</option>
                    <option value="ACTIVO" {{ request('status') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ request('status') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>

                <button type="submit" class="btn btn-sm btn-outline-primary">Filtrar</button>
                <a href="{{ route('usuario') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </form>

            <a href="{{ route('usuario.nuevo') }}"
                class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Agregar nuevo usuario
            </a>
        </div>
        @include('backend.mensajes')
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="d-flex align-items-center gap-10">
                                    #
                                </div>
                            </th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombres</th>
                            {{-- <th scope="col">Apellidos</th> --}}
                            <th scope="col">Nombre de usuario</th>
                            {{-- <th scope="col">Email</th> --}}
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-10">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($usuario->imagen)
                                            <img src="{{ asset('storage/perfil/' . $usuario->imagen) }}" alt="perfil"
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        @else
                                            <img src="{{ asset('assets/images/no-image.jpg') }}" alt=""
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $usuario->nombres }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $usuario->apellidos }}
                                            </span>
                                        </div>
                                    </div>
                                </td> --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 text-center">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $usuario->username }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td>
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        {{ $usuario->email }}
                                    </span>
                                </td> --}}
                                <td class="text-center">
                                    @if ($usuario->estado === 'ACTIVO')
                                        <span
                                            class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">
                                            {{ $usuario->estado }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-neutral-200 text-neutral-600 border border-neutral-400 px-24 py-4 radius-4 fw-medium text-sm">
                                            {{ $usuario->estado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <a href="{{ route('usuario.editar', $usuario->cod_usuario) }}"
                                            class="bg-warning-focus text-warning-600 bg-hover-warning-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                        @if ($usuario->cod_usuario != 1)
                                            <button type="button"
                                                class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                                data-id="{{ $usuario->cod_usuario }}">
                                                <iconify-icon icon="fluent:delete-24-regular"
                                                    class="menu-icon"></iconify-icon>
                                            </button>
                                            <form action="{{ route('usuario.eliminar', $usuario->cod_usuario) }}" method="POST"
                                                id="form-eliminar-{{ $usuario->cod_usuario }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Mostrando
                    {{ $usuarios->firstItem() ?? 0 }}
                    a
                    {{ $usuarios->lastItem() ?? 0 }}
                    de
                    {{ $usuarios->total() }}
                    registros
                </span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Botón anterior --}}
                    <li class="page-item {{ $usuarios->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $usuarios->previousPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                        </a>
                    </li>

                    {{-- Páginas --}}
                    @foreach ($usuarios->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $usuarios->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md {{ $usuarios->currentPage() == $page ? 'bg-primary-600 text-white' : 'bg-neutral-300 text-secondary-light' }}"
                                href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    {{-- Botón siguiente --}}
                    <li class="page-item {{ $usuarios->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $usuarios->nextPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

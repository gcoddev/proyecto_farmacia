@extends('backend.layout.layout')

@php
    $title = 'Productos';
    $subTitle = 'Lista de productos';
    $script = '<script>
        $(".remove-item-btn").on("click", function() {
            const id = $(this).data("id");
            console.log(id);
            Swal.fire({
                title: "<h6>¿Estás seguro de eliminar este producto?</h6>",
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
            <form method="GET" action="{{ route('producto') }}" class="d-flex align-items-center flex-wrap gap-3">
                <span class="text-md fw-medium text-secondary-light mb-0">Mostrar</span>
                <select id="recordsPerPage" class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px"
                    name="per_page">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>

                <div class="navbar-search">
                    <iconify-icon icon="mdi:search" class="icon text-xl line-height-1"></iconify-icon>
                    <input type="text" class="bg-base h-40-px w-auto" name="search" value="{{ request('search') }}"
                        placeholder="Buscar">
                </div>

                <button type="submit" class="btn btn-sm btn-outline-primary">Filtrar</button>
                <a href="{{ route('producto') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </form>

            <a href="{{ route('producto.nuevo') }}"
                class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Agregar nuevo producto
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
                            <th scope="col">Nombres</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">P/Unit</th>
                            <th scope="col">Precio caja</th>
                            <th scope="col">Categoría</th>
                            <th scope="col" class="text-center">acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $prod)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-10">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $prod->nombre_prod }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                {{ $prod->presentacion }}
                                                x
                                                {{ $prod->cantidad }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                Bs. {{ $prod->precio }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                Bs. {{ $prod->precio_caja }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-md mb-0 fw-normal badge bg-info">
                                                {{ $prod->categoria->nombre_cat }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center gap-10 justify-content-center">
                                        <a href="{{ route('producto.editar', $prod->cod_producto) }}"
                                            class="bg-warning-focus text-warning-600 bg-hover-warning-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                        <button type="button"
                                            class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                            data-id="{{ $prod->cod_producto }}">
                                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                        </button>
                                        <form action="{{ route('producto.eliminar', $prod->cod_producto) }}" method="POST"
                                            id="form-eliminar-{{ $prod->cod_producto }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
                    {{ $productos->firstItem() ?? 0 }}
                    a
                    {{ $productos->lastItem() ?? 0 }}
                    de
                    {{ $productos->total() }}
                    registros
                </span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Botón anterior --}}
                    <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $productos->previousPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                        </a>
                    </li>

                    {{-- Páginas --}}
                    @foreach ($productos->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $productos->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md {{ $productos->currentPage() == $page ? 'bg-primary-600 text-white' : 'bg-neutral-300 text-secondary-light' }}"
                                href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    {{-- Botón siguiente --}}
                    <li class="page-item {{ $productos->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $productos->nextPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

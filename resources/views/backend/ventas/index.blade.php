@extends('backend.layout.layout')

@php
    $title = 'Ventas';
    $subTitle = 'Lista de ventas';
    $script = '<script>
        // $(".remove-item-btn").on("click", function() {
        //     const id = $(this).data("id");
        //     console.log(id);
        //     Swal.fire({
        //         title: "<h6>¿Estás seguro de eliminar esta categoría?</h6>",
        //         text: "Esta acción no se puede deshacer.",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Si, eliminar",
        //     }).then(function(response) {
        //         if (response.isConfirmed) {
        //             $("#form-eliminar-" + id).submit();
        //         }
        //     })
        // })
    </script>';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <form method="GET" action="{{ route('venta') }}" class="d-flex align-items-center flex-wrap gap-3">
                <span class="text-md fw-medium text-secondary-light mb-0">Mostrar</span>
                <select id="recordsPerPage" class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px"
                    name="per_page">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>

                {{-- <div class="navbar-search">
                    <iconify-icon icon="mdi:search" class="icon text-xl line-height-1"></iconify-icon>
                    <input type="text" class="bg-base h-40-px w-auto" name="search" value="{{ request('search') }}"
                        placeholder="Buscar">
                </div> --}}

                <button type="submit" class="btn btn-sm btn-outline-primary">Filtrar</button>
                <a href="{{ route('venta') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </form>

            <div class="d-flex">
                <a href="{{ route('pdf.ventas') }}" target="_blank"
                    class="btn btn-danger text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2 me-3">
                    <iconify-icon icon="flowbite:file-pdf-outline" class="icon text-xl line-height-1"></iconify-icon>
                    Generar PDF
                </a>
                <a href="{{ route('venta.nuevo') }}"
                    class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Agregar nueva venta
                </a>
            </div>
        </div>
        @include('backend.mensajes')
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table table-hover sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="d-flex align-items-center gap-10">
                                    #
                                </div>
                            </th>
                            <th scope="col">
                                <div class="d-flex align-items-center gap-10">
                                    Venta
                                </div>
                            </th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Productos</th>
                            <th scope="col">P/Unit</th>
                            <th scope="col">Precio total</th>
                            <th scope="col">Venta total</th>
                            <th scope="col">Fecha</th>
                            {{-- <th scope="col" class="text-center">acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont = 1;
                        @endphp
                        @foreach ($ventasAgrupadas as $grupo)
                            @foreach ($grupo['productos'] as $index => $venta)
                                <tr>
                                    @if ($index === 0)
                                        <td rowspan="{{ $grupo['productos']->count() }}">
                                            {{ $cont }}
                                        </td>
                                        <td rowspan="{{ $grupo['productos']->count() }}">
                                            #{{ $venta->codigo }}
                                        </td>
                                        <td rowspan="{{ $grupo['productos']->count() }}">
                                            {{ $grupo['cliente'] ? $grupo['cliente']->nombre_cli : '-' }}
                                        </td>
                                    @endif
                                    <td>
                                        {{ $venta->cantidad }}
                                        &nbsp;
                                        {{ $venta->producto->nombre_prod }}
                                    </td>
                                    <td>
                                        Bs. {{ $venta->precio_unitario }}
                                    </td>
                                    <td>Bs. {{ $venta->precio_total }}</td>
                                    @if ($index === 0)
                                        <td rowspan="{{ $grupo['productos']->count() }}">
                                            <b>Bs. {{ $grupo['total_precio'] }}</b>
                                        </td>
                                        <td rowspan="{{ $grupo['productos']->count() }}">{{ $grupo['fecha_venta'] }}</td>
                                    @endif
                                </tr>
                            @endforeach
                            @php
                                $cont++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Mostrando
                    {{ $ventas->firstItem() ?? 0 }}
                    a
                    {{ $ventas->lastItem() ?? 0 }}
                    de
                    {{ $ventas->total() }}
                    registros
                </span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Botón anterior --}}
                    <li class="page-item {{ $ventas->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $ventas->previousPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                        </a>
                    </li>

                    {{-- Páginas --}}
                    @foreach ($ventas->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $ventas->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md {{ $ventas->currentPage() == $page ? 'bg-primary-600 text-white' : 'bg-neutral-300 text-secondary-light' }}"
                                href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    {{-- Botón siguiente --}}
                    <li class="page-item {{ $ventas->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $ventas->nextPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@extends('backend.layout.layout')

@php
    $title = 'Compras';
    $subTitle = 'Lista de compras';
    $script = '<script>
        // $(".remove-item-btn").on("click", function() {
        //     const id = $(this).data("id");
        //     console.log(id);
        //     Swal.fire({
        //         title: "<h6>¿Estás seguro de eliminar este producto?</h6>",
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

    use Carbon\Carbon;
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div
            class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <form method="GET" action="{{ route('compra') }}" class="d-flex align-items-center flex-wrap gap-3">
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

                <button type="submit" class="btn btn-sm btn-outline-primary">Filtrar</button>
                <a href="{{ route('compra') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </form>

            <div class="d-flex">
                <a href="{{ route('pdf.compras') }}" target="_blank"
                    class="btn btn-danger text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2 me-3">
                    <iconify-icon icon="flowbite:file-pdf-outline" class="icon text-xl line-height-1"></iconify-icon>
                    Generar PDF
                </a>
                <a href="{{ route('compra.nuevo') }}"
                    class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Agregar nueva compra
                </a>
            </div>
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
                            <th scope="col">Producto</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Fecha compra</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Monto total</th>
                            <th scope="col">Stock actual</th>
                            <th scope="col">Precio comercial</th>
                            <th scope="col">Fecha caducidad</th>
                            <th scope="col" class="text-center">Restantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $compra)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-10">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower($compra->producto->nombre_prod), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        {{ $compra->producto->nombre_prod }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower($compra->proveedor->nombre_prov), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        {{ $compra->proveedor->nombre_prov }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower($compra->fecha_compra), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        {{ $compra->fecha_compra }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower($compra->cantidad), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        {{ $compra->cantidad }} x {{ $compra->producto->cantidad }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower($compra->monto_total), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        Bs. {{ $compra->monto_total }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower(optional($compra->precio)->stock), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="badge bg-primary fw-bold" style="font-size:1.01em;">
                                        {{ optional($compra->precio)->stock }} {{ $unidad ?? '' }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower(optional($compra->precio)->precio_unitario), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        Bs. {{ optional($compra->precio)->precio_unitario }}
                                    </span>
                                </td>
                                <td
                                    class="{{ request('search') && str_contains(strtolower(optional($compra->precio)->fecha_caducidad), strtolower(request('search'))) ? 'bg-primary-100' : '' }}">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">
                                        {{ optional($compra->precio)->fecha_caducidad
                                            ? str_replace(
                                                '.',
                                                '',
                                                \Carbon\Carbon::parse(optional($compra->precio)->fecha_caducidad)->locale('es')->translatedFormat('M-Y'),
                                            )
                                            : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if (optional($compra->precio)->fecha_caducidad)
                                        @php
                                            $fechaCaducidad = Carbon::parse(
                                                $compra->precio->fecha_caducidad,
                                            )->endOfDay();
                                            $fechaActual = Carbon::now();
                                            $diasRestantes = $fechaActual
                                                ->copy()
                                                ->startOfDay()
                                                ->diffInDays($fechaCaducidad->copy()->startOfDay(), false);
                                        @endphp

                                        @if ($diasRestantes > 7)
                                            <span class="badge bg-success">{{ $diasRestantes }} días restantes</span>
                                        @elseif ($diasRestantes > 1)
                                            <span class="badge bg-warning text-dark">{{ $diasRestantes }} días
                                                restantes</span>
                                        @elseif ($diasRestantes == 1)
                                            <span class="badge bg-warning text-dark">{{ $diasRestantes }} día
                                                restante</span>
                                        @else
                                            <span class="badge bg-danger">Caducado hace {{ abs($diasRestantes) }}
                                                días</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                <span>
                    Mostrando
                    {{ $compras->firstItem() ?? 0 }}
                    a
                    {{ $compras->lastItem() ?? 0 }}
                    de
                    {{ $compras->total() }}
                    registros
                </span>
                <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                    {{-- Botón anterior --}}
                    <li class="page-item {{ $compras->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $compras->previousPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                        </a>
                    </li>

                    {{-- Páginas --}}
                    @foreach ($compras->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $compras->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md {{ $compras->currentPage() == $page ? 'bg-primary-600 text-white' : 'bg-neutral-300 text-secondary-light' }}"
                                href="{{ $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    {{-- Botón siguiente --}}
                    <li class="page-item {{ $compras->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md"
                            href="{{ $compras->nextPageUrl() ?? 'javascript:void(0)' }}">
                            <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

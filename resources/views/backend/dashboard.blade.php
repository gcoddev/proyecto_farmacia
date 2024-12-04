@extends('backend.layout.layout')

@php
    $title = 'Inicio';
    $subTitle = 'Inicio';
    $script = '<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';

    use Carbon\Carbon;
@endphp

@section('content')
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total usuarios</p>
                            <h6 class="mb-0">{{ $users }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +5000
                        </span>
                        Last 30 days users
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total clientes</p>
                            <h6 class="mb-0">{{ $clientes }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800
                        </span>
                        Last 30 days subscription
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total proveedores</p>
                            <h6 class="mb-0">{{ $proveedores }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +200
                        </span>
                        Last 30 days users
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total de ventas</p>
                            <h6 class="mb-0">Bs. {{ $ventas }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$20,000
                        </span>
                        Last 30 days income
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total de compras</p>
                            <h6 class="mb-0">Bs. {{ $compras }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:file-invoice-dollar"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$5,000
                        </span>
                        Last 30 days expense
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
    </div>
    <div class="row gy-4 mt-1">
        <div class="col-xl-12">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                        <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab"
                                    aria-controls="pills-to-do-list" aria-selected="true">
                                    Ultimas ventas
                                    <span
                                        class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">
                                        {{ count($ventasAgrupadas) }}
                                    </span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab"
                                    aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                                    Ultimas compras (Stock)
                                    <span
                                        class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">
                                        {{ count($comprasAgrupadas) }}
                                    </span>
                                </button>
                            </li>
                        </ul>
                        {{-- <a href="{{ route('venta') }}"
                            class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            Ver todo
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a> --}}
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel"
                            aria-labelledby="pills-to-do-list-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table table-hover sm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <div class="d-flex align-items-center gap-10">
                                                    Venta
                                                </div>
                                            </th>
                                            <th scope="col">Cliente</th>
                                            <th scope="col">Productos</th>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">P/Unit</th>
                                            <th scope="col">Precio total</th>
                                            <th scope="col">Venta total</th>
                                            <th scope="col">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($ventasAgrupadas as $grupo)
                                            @foreach ($grupo['productos'] as $index => $venta)
                                                <tr>
                                                    @if ($index === 0)
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
                                                        <span class="badge bg-info">
                                                            {{ $venta->producto->categoria->nombre_cat }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        Bs. {{ $venta->precio_unitario }}
                                                    </td>
                                                    <td>Bs. {{ $venta->precio_total }}</td>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ $grupo['productos']->count() }}">
                                                            <b>Bs. {{ $grupo['total_precio'] }}</b>
                                                        </td>
                                                        <td rowspan="{{ $grupo['productos']->count() }}">
                                                            {{ $grupo['fecha_venta'] }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            @php
                                                if ($count == 10) {
                                                    break;
                                                }
                                                $count++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel"
                            aria-labelledby="pills-recent-leads-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table table-hover sm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Proveedor</th>
                                            <th scope="col">Fecha compra</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Stock actual</th>
                                            <th scope="col">Precio comercial</th>
                                            <th scope="col">Fecha caducidad</th>
                                            <th scope="col" class="text-center">Restantes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($comprasAgrupadas as $compra)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                {{ $compra->producto->nombre_prod }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                {{ $compra->proveedor->nombre_prov }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                {{ $compra->fecha_compra }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                {{ $compra->cantidad }} x
                                                                {{ $compra->producto->cantidad }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                @php
                                                                    $texto = $compra->producto->cantidad;
                                                                    $numero = 0;
                                                                    $unidad = '';
                                                                    if (
                                                                        preg_match(
                                                                            '/\d+/',
                                                                            $texto,
                                                                            $matches,
                                                                            PREG_OFFSET_CAPTURE,
                                                                        )
                                                                    ) {
                                                                        $numero = $matches[0][0];
                                                                        $indiceFinalNumero =
                                                                            $matches[0][1] + strlen($numero);
                                                                        $textoDespues = trim(
                                                                            substr($texto, $indiceFinalNumero),
                                                                        );
                                                                        $unidad =
                                                                            $textoDespues !== '' ? $textoDespues : null;
                                                                    }
                                                                @endphp
                                                                <span class="badge bg-info fw-bold"
                                                                    style="font-size:1.01em;">
                                                                    {{ $compra->precio->stock }} {{ $unidad }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                Bs. {{ $compra->precio->precio_unitario }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <span class="text-md mb-0 fw-normal text-secondary-light">
                                                                {{ $compra->precio->fecha_caducidad? str_replace('.','',Carbon::parse($compra->precio->fecha_caducidad)->locale('es')->translatedFormat('M-Y')): '-' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            @if ($compra->precio->fecha_caducidad)
                                                                @php
                                                                    $fechaCaducidad = Carbon::parse(
                                                                        $compra->precio->fecha_caducidad,
                                                                    )->endOfDay(); // Final del día
                                                                    $fechaActual = Carbon::now();

                                                                    // Calcular días restantes con signo y redondear
                                                                    $diasRestantes = $fechaActual
                                                                        ->copy()
                                                                        ->startOfDay()
                                                                        ->diffInDays(
                                                                            $fechaCaducidad->copy()->startOfDay(),
                                                                            false,
                                                                        );
                                                                @endphp

                                                                @if ($diasRestantes > 7)
                                                                    <span class="badge bg-success">{{ $diasRestantes }}
                                                                        días
                                                                        restantes</span>
                                                                @elseif ($diasRestantes > 1)
                                                                    <span
                                                                        class="badge bg-warning text-dark">{{ $diasRestantes }}
                                                                        días
                                                                        restantes</span>
                                                                @elseif ($diasRestantes == 1)
                                                                    <span
                                                                        class="badge bg-warning text-dark">{{ $diasRestantes }}
                                                                        día
                                                                        restantes</span>
                                                                @else
                                                                    <span class="badge bg-danger">Caducado hace
                                                                        {{ abs($diasRestantes) }}
                                                                        días</span>
                                                                @endif
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                if ($count == 10) {
                                                    break;
                                                }
                                                $count++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

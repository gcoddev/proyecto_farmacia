@extends('backend.layout.layout')

@php
    $title = 'Estadísticas de Compras';
    $subTitle = 'Compras';
    // $script = '<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';

    use Carbon\Carbon;
@endphp

@section('content')
    <div class="row row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total de Compras</p>
                            <h6 class="mb-0">Bs. {{ $totalCompras }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:file-invoice-dollar"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +Bs. 150
                        </span>
                        Los ultimos 30 dias
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
    </div>
    <div class="row gy-4 mt-1">
        <div class="col-xxl-9 col-xl-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                        <h6 class="mb-0">Bs. 150</h6>
                        {{-- <span
                            class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1 d-flex align-items-center gap-1">
                            100% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                        </span>
                        <span class="text-xs fw-medium">+ Bs. 150 por dia</span> --}}
                    </div>
                    <div id="comprasMeses" class="pt-28 apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card h-100 radius-8 border-0 overflow-hidden">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Compras por proveedor</h6>
                        {{-- <div class="">
                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                <option>Today</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                                <option>Yearly</option>
                            </select>
                        </div> --}}
                    </div>


                    <div id="comprasProveedores"></div>
                    <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                        @foreach ($proveedoresNombres as $index => $proveedor)
                            <li class="d-flex align-items-center gap-2">
                                <span class="w-12-px h-12-px radius-2"
                                    style="background-color: {{ $coloresProveedores[$index] }}"></span>
                                <span class="text-secondary-light text-sm fw-normal">
                                    {{ $proveedor }}:
                                    <span class="text-primary-light fw-semibold">{{ $proveedoresTotales[$index] }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Proveedores</h6>
                    </div>

                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <div class="h-100 border p-16 pe-0 radius-8">
                                <div class="max-h-266-px overflow-y-auto scroll-sm pe-16">
                                    @foreach ($comprasPorProveedor as $proveedor)
                                        <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                            <div class="d-flex align-items-center w-100">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-sm mb-0">{{ $proveedor->proveedor }}</h6>
                                                    <span
                                                        class="text-xs text-secondary-light fw-medium">{{ $proveedor->total }}
                                                        Compras</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 w-100">
                                                <div class="w-100 max-w-66 ms-auto">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Progress bar for {{ $proveedor->proveedor }}"
                                                        aria-valuenow="{{ round($proveedor->porcentaje) }}"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-primary-600 rounded-pill"
                                                            style="width: {{ round($proveedor->porcentaje) }}%;"></div>
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-secondary-light font-xs fw-semibold">{{ round($proveedor->porcentaje) }}%</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9 col-xl-12">
            <div class="card h-100">
                <div class="card-body p-24">
                    <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                        <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center active" id="pills-recent-leads-tab"
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
                        <div class="tab-pane fade show active" id="pills-recent-leads" role="tabpanel"
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

@push('scripts')
    <script>
        var options1 = {
            series: [{
                name: "Compras por mes",
                data: @json($comprasOrden)
            }],
            chart: {
                height: 264,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    top: 6,
                    left: 0,
                    blur: 4,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                colors: ['#487FFF'],
                width: 3
            },
            markers: {
                size: 0,
                strokeWidth: 3,
                hover: {
                    size: 8
                }
            },
            tooltip: {
                enabled: true,
                x: {
                    show: true,
                },
                y: {
                    show: false,
                },
                z: {
                    show: false,
                }
            },
            grid: {
                row: {
                    colors: ['transparent', 'transparent'],
                    opacity: 0.5
                },
                borderColor: '#D1D5DB',
                strokeDashArray: 3,
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return "Bs. " + value.toFixed(2);
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                tooltip: {
                    enabled: false
                },
                labels: {
                    formatter: function(value) {
                        return value;
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
                axisBorder: {
                    show: false
                },
                crosshairs: {
                    show: true,
                    width: 20,
                    stroke: {
                        width: 0
                    },
                    fill: {
                        type: 'solid',
                        color: '#487FFF40'
                    }
                }
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#comprasMeses"), options1);
        chart1.render();

        var options2 = {
            series: @json(array_map('intval', $proveedoresTotales)),
            colors: @json($coloresProveedores),
            labels: @json($proveedoresNombres),
            legend: {
                show: false
            },
            chart: {
                type: 'donut',
                height: 270,
                sparkline: {
                    enabled: true // Remove whitespace
                },
                margin: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            },
            stroke: {
                width: 0,
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
        };

        var chart2 = new ApexCharts(document.querySelector("#comprasProveedores"), options2);
        chart2.render();
    </script>
@endpush

@extends('backend.layout.layout')

@php
    $title = 'Estadísticas de ventas';
    $subTitle = 'Ventas';
    // $script = '<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';
@endphp

@section('content')
    <div class="row row-cols-sm-2 row-cols-1 gy-4">
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
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> + Bs.150
                        </span>
                        Los ultimos 30 dias
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
    </div>
    <div class="row gy-4 mt-1">
        <div class="col-xxl-6 col-xl-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                        <h6 class="mb-0">Bs. {{ $ventas }}</h6>
                        {{-- <span
                            class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1 d-flex align-items-center gap-1">
                            100% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                        </span>
                        <span class="text-xs fw-medium">+ Bs. 150 por dia</span> --}}
                    </div>
                    <div id="ventasMeses" class="pt-28 apexcharts-tooltip-style-1"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card h-100 radius-8 border">
                <div class="card-body p-24">
                    <h6 class="mb-12 fw-semibold text-lg mb-16">Total ventas por dia</h6>
                    <div class="d-flex align-items-center gap-2 mb-20">
                        <h6 class="fw-semibold mb-0">Bs. {{ $ventas }}</h6>
                        {{-- <p class="text-sm mb-0">
                            <span
                                class="bg-success-focus border br-success px-8 py-2 rounded-pill fw-semibold text-success-main text-sm d-inline-flex align-items-center gap-1">
                                10%
                                <iconify-icon icon="iconamoon:arrow-down-2-fill" class="icon"></iconify-icon>
                            </span>
                            + 10 Por dia
                        </p> --}}
                    </div>

                    <div id="ventasDia"></div>

                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card h-100 radius-8 border-0 overflow-hidden">
                <div class="card-body p-24">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                        <h6 class="mb-2 fw-bold text-lg">Ventas por categorías</h6>
                        {{-- <div class="">
                            <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                <option>Today</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                                <option>Yearly</option>
                            </select>
                        </div> --}}
                    </div>


                    <div id="ventasCategoria"></div>

                    <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                        @foreach ($categorias as $index => $categoria)
                            <li class="d-flex align-items-center gap-2">
                                <span class="w-12-px h-12-px radius-2"
                                    style="background-color: {{ $colores[$index] }};"></span>
                                <span class="text-secondary-light text-sm fw-normal">{{ $categoria }}:
                                    <span class="text-primary-light fw-semibold">{{ $valores[$index] }}</span>
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
                        <h6 class="mb-2 fw-bold text-lg mb-0">Top categorías</h6>
                    </div>

                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <div class="h-100 border p-16 pe-0 radius-8">
                                <div class="max-h-266-px overflow-y-auto scroll-sm pe-16">
                                    @foreach ($topCategorias as $categoria)
                                        <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                            <div class="d-flex align-items-center w-100">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-sm mb-0">{{ $categoria->categoria }}</h6>
                                                    <span
                                                        class="text-xs text-secondary-light fw-medium">{{ $categoria->total_cantidad }}
                                                        ventas</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 w-100">
                                                <div class="w-100 max-w-66 ms-auto">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-valuenow="{{ round($categoria->porcentaje) }}"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar bg-primary-600 rounded-pill"
                                                            style="width: {{ round($categoria->porcentaje) }}%;"></div>
                                                    </div>
                                                </div>
                                                <span
                                                    class="text-secondary-light font-xs fw-semibold">{{ round($categoria->porcentaje) }}%</span>
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
                        </ul>
                        <a href="{{ route('venta') }}"
                            class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            Ver todo
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
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
                                                if ($count == 5) {
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

    {{-- @dd(array_map('intval', $valores->toArray())) --}}
@endsection

@push('scripts')
    <script>
        var options1 = {
            series: [{
                name: "Ventas del mes",
                data: @json($ventasPorMes)
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
                tickAmount: 5,
                max: @json($yValues[0]), // Máximo del eje Y
                min: 0
            },
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
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
        var chart1 = new ApexCharts(document.querySelector("#ventasMeses"), options1);
        chart1.render();

        var options2 = {
            series: [{
                name: "Ventas",
                data: [{
                        x: 'Dom',
                        y: @json($ventasPorDia[0])
                    },
                    {
                        x: 'Lun',
                        y: @json($ventasPorDia[1])
                    },
                    {
                        x: 'Mar',
                        y: @json($ventasPorDia[2])
                    },
                    {
                        x: 'Mie',
                        y: @json($ventasPorDia[3])
                    },
                    {
                        x: 'Jue',
                        y: @json($ventasPorDia[4])
                    },
                    {
                        x: 'Vie',
                        y: @json($ventasPorDia[5])
                    },
                    {
                        x: 'Sab',
                        y: @json($ventasPorDia[6])
                    }
                ]
            }],
            chart: {
                type: 'bar',
                height: 235,
                toolbar: {
                    show: false
                },
            },
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    horizontal: false,
                    columnWidth: '52%',
                    endingShape: 'rounded',
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
                colors: ['#dae5ff'],
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#dae5ff'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100],
                },
            },
            grid: {
                show: false,
                borderColor: '#D1D5DB',
                strokeDashArray: 4,
                position: 'back',
                padding: {
                    top: -10,
                    right: -10,
                    bottom: -10,
                    left: -10
                }
            },
            xaxis: {
                type: 'category',
                categories: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
            },
            yaxis: {
                show: false,
                max: @json(floatval($valorMaximo))
            },
        };

        var chart2 = new ApexCharts(document.querySelector("#ventasDia"), options2);
        chart2.render();

        var options3 = {
            series: @json(array_map('intval', $valores->toArray())),
            colors: @json($colores),
            labels: @json($categorias),
            legend: {
                show: false
            },
            chart: {
                type: 'donut',
                height: 270,
                sparkline: {
                    enabled: true
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

        var chart3 = new ApexCharts(document.querySelector("#ventasCategoria"), options3);
        chart3.render();
    </script>
@endpush

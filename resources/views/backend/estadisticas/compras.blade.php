@extends('backend.layout.layout')

@php
    $title = 'Estadísticas de Compras';
    $subTitle = 'Compras';
    $script = '<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';

@endphp

@section('content')
    <div class="row row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total de Compras</p>
                            <h6 class="mb-0">Bs. 150</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:file-invoice-dollar"
                                class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +Bs. 150
                        </span>
                        Los ultimos 30 dias
                    </p>
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
                        <span
                            class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1 d-flex align-items-center gap-1">
                            100% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                        </span>
                        <span class="text-xs fw-medium">+ Bs. 150 por dia</span>
                    </div>
                    <div id="chart" class="pt-28 apexcharts-tooltip-style-1"></div>
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


                    <div id="userOverviewDonutChart"></div>

                    <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                            <span class="text-secondary-light text-sm fw-normal">Proveedor 1
                                <span class="text-primary-light fw-semibold">1</span>
                            </span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-danger-400"></span>
                            <span class="text-secondary-light text-sm fw-normal">Proveedor 2:
                                <span class="text-primary-light fw-semibold">2</span>
                            </span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                            <span class="text-secondary-light text-sm fw-normal">Proveedor 3:
                                <span class="text-primary-light fw-semibold">3</span>
                            </span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                        <h6 class="mb-2 fw-bold text-lg mb-0">Proveedores</h6>
                        {{-- <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                            <option>Today</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Yearly</option>
                        </select> --}}
                    </div>

                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <div class="h-100 border p-16 pe-0 radius-8">
                                <div class="max-h-266-px overflow-y-auto scroll-sm pe-16">
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">Proveedor 1</h6>
                                                <span class="text-xs text-secondary-light fw-medium">1 Compras</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar bg-primary-600 rounded-pill"
                                                        style="width: 20%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">20%</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">Proveedor 2</h6>
                                                <span class="text-xs text-secondary-light fw-medium">2 Compras</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar bg-primary-600 rounded-pill"
                                                        style="width: 30%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">30%</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="flex-grow-1">
                                                <h6 class="text-sm mb-0">Proveedor 3</h6>
                                                <span class="text-xs text-secondary-light fw-medium">3 Compras</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="w-100 max-w-66 ms-auto">
                                                <div class="progress progress-sm rounded-pill" role="progressbar"
                                                    aria-label="Success example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar bg-primary-600 rounded-pill"
                                                        style="width: 50%;"></div>
                                                </div>
                                            </div>
                                            <span class="text-secondary-light font-xs fw-semibold">50%</span>
                                        </div>
                                    </div>
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
                                    data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button"
                                    role="tab" aria-controls="pills-to-do-list" aria-selected="true">
                                    Últimos registros
                                    {{-- <span
                                        class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">35</span> --}}
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel"
                            aria-labelledby="pills-to-do-list-tab" tabindex="0">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table sm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Proveedor </th>
                                            <th scope="col">Registrado el</th>
                                            <th scope="col">Productos</th>
                                            <th scope="col" class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                                        <span
                                                            class="text-sm text-secondary-light fw-medium">redaniel@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <ul>
                                                    <li>Prod 1</li>
                                                    <li>Prod 2</li>
                                                    <li>Prod 3</li>
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Bs.
                                                    50</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                                        <span
                                                            class="text-sm text-secondary-light fw-medium">redaniel@gmail.com</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>27 Mar 2024</td>
                                            <td>
                                                <ul>
                                                    <li>Prod 4</li>
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Bs. 50</span>
                                            </td>
                                        </tr>
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
        var options = {
            series: [1, 2, 3],
            colors: ['#487FFF', '#FF1255', '#FF7512'],
            labels: ['categoria 1', 'Categoria 2', 'Categoria3'],
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

        var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
        chart.render();

        var options = {
            series: [{
                name: "Sales",
                data: [{
                    x: 'Sun',
                    y: 15,
                }, {
                    x: 'Mon',
                    y: 12,
                }, {
                    x: 'Tue',
                    y: 18,
                }, {
                    x: 'Wed',
                    y: 20,
                }, {
                    x: 'Thu',
                    y: 13,
                }, {
                    x: 'Fri',
                    y: 16,
                }, {
                    x: 'Sat',
                    y: 6,
                }]
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
                    columnWidth: 24,
                    columnWidth: '52%',
                    endingShape: 'rounded',
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
                colors: ['#dae5ff'], // Set the starting color (top color) here
                gradient: {
                    shade: 'light', // Gradient shading type
                    type: 'vertical', // Gradient direction (vertical)
                    shadeIntensity: 0.5, // Intensity of the gradient shading
                    gradientToColors: ['#dae5ff'], // Bottom gradient color (with transparency)
                    inverseColors: false, // Do not invert colors
                    opacityFrom: 1, // Starting opacity
                    opacityTo: 1, // Ending opacity
                    stops: [0, 100],
                },
            },
            grid: {
                show: false,
                borderColor: '#D1D5DB',
                strokeDashArray: 4, // Use a number for dashed style
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
                categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            },
            yaxis: {
                show: false,
                // labels: {
                //     formatter: function (value) {
                //         return (value / 1000).toFixed(0) + 'k';
                //     }
                // }
            },
            // tooltip: {
            //     y: {
            //         formatter: function (value) {
            //             return value / 1000 + 'k';
            //         }
            //     }
            // }
        };

        var chart = new ApexCharts(document.querySelector("#barChart"), options);
        chart.render();

        var options = {
            series: [{
                name: "This month",
                data: [10, 20, 12, 30, 14, 35, 16, 32, 14, 25, 13, 28]
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
                colors: ['#487FFF'], // Specify the line color here
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
                    colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
                borderColor: '#D1D5DB',
                strokeDashArray: 3,
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return "$" + value + "k";
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
                        color: '#487FFF40',
                        // gradient: {
                        //   colorFrom: '#D8E3F0',
                        //   // colorTo: '#BED1E6',
                        //   stops: [0, 100],
                        //   opacityFrom: 0.4,
                        //   opacityTo: 0.5,
                        // },
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush

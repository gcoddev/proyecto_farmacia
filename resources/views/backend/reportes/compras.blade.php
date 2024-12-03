<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Reporte de Compras</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Proveedor</th>
                <th>Fecha compra</th>
                <th>Cantidad</th>
                <th>Monto total</th>
                <th>Stock actual</th>
                <th>Precio comercial</th>
                <th>Fecha caducidad</th>
                <th>Restantes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $compra->producto->nombre_prod }}</td>
                    <td>{{ $compra->proveedor->nombre_prov }}</td>
                    <td>{{ $compra->fecha_compra }}</td>
                    <td>{{ $compra->cantidad }} x {{ $compra->producto->cantidad }}</td>
                    <td>Bs. {{ $compra->monto_total }}</td>
                    <td>{{ $compra->precio[0]->stock ?? 'N/A' }}</td>
                    <td>Bs. {{ $compra->precio[0]->precio_unitario ?? 'N/A' }}</td>
                    <td>{{ str_replace('.','',\Carbon\Carbon::parse($compra->precio[0]->fecha_caducidad)->locale('es')->translatedFormat('M-Y')) ?? 'N/A' }}
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                @php
                                    $fechaCaducidad = \Carbon\Carbon::parse(
                                        $compra->precio[0]->fecha_caducidad,
                                    )->endOfDay(); // Final del día
                                    $fechaActual = \Carbon\Carbon::now();

                                    // Calcular días restantes con signo y redondear
                                    $diasRestantes = $fechaActual
                                        ->copy()
                                        ->startOfDay()
                                        ->diffInDays($fechaCaducidad->copy()->startOfDay(), false);
                                @endphp

                                @if ($diasRestantes > 7)
                                    <span style="color:green">{{ $diasRestantes }} días restantes</span>
                                @elseif ($diasRestantes > 1)
                                    <span style="color:orange">{{ $diasRestantes }} días
                                        restantes</span>
                                @elseif ($diasRestantes == 1)
                                    <span style="color:orange">{{ $diasRestantes }} día
                                        restantes</span>
                                @elseif ($diasRestantes == 0)
                                    <span style="color:red">Caduca hoy</span>
                                @else
                                    <span style="color:red">Caducado hace {{ abs($diasRestantes) }}
                                        días</span>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

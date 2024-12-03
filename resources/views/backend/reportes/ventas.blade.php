<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Reporte de Ventas</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Venta</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>P/Unit</th>
                <th>Precio total</th>
                <th>Venta total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @php $cont = 1; @endphp
            @foreach ($ventasAgrupadas as $grupo)
                @foreach ($grupo['productos'] as $index => $venta)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ $grupo['productos']->count() }}">{{ $cont }}</td>
                            <td rowspan="{{ $grupo['productos']->count() }}">#{{ $venta->codigo }}</td>
                            <td rowspan="{{ $grupo['productos']->count() }}">
                                {{ $grupo['cliente'] ? $grupo['cliente']->nombre_cli : '-' }}</td>
                        @endif
                        <td>{{ $venta->cantidad }} {{ $venta->producto->nombre_prod }}</td>
                        <td>Bs. {{ $venta->precio_unitario }}</td>
                        <td>Bs. {{ $venta->precio_total }}</td>
                        @if ($index === 0)
                            <td rowspan="{{ $grupo['productos']->count() }}"><b>Bs. {{ $grupo['total_precio'] }}</b>
                            </td>
                            <td rowspan="{{ $grupo['productos']->count() }}">{{ $grupo['fecha_venta'] }}</td>
                        @endif
                    </tr>
                @endforeach
                @php $cont++; @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html>

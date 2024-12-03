@extends('backend.layout.layout2')

@php
    $title = 'Nueva venta';
    $subTitle = 'Ventas';
    $script = '<script src="' . asset('assets/js/invoice.js') . '"></script>';
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <a href="{{ route('venta') }}"
                    class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                    Ver lista de ventas
                </a>
                <button type="button" class="btn btn-sm btn-success-600 radius-8 d-inline-flex align-items-center gap-1"
                    onclick="submitVenta()" id="btn-submit">
                    <iconify-icon icon="simple-line-icons:check" class="text-xl"></iconify-icon>
                    Realizar venta
                </button>
            </div>
        </div>
        @include('backend.mensajes')
        <div class="card-body py-40">
            <div class="row justify-content-center" id="invoice">
                <div class="col-lg-8">
                    <div class="shadow-4 border radius-8">
                        <div class="p-20 border-bottom">
                            <div class="row justify-content-between g-3">
                                <div class="col-sm-4">
                                    <h3 class="text-xl">Venta #{{ $old }}</h3>
                                    <p class="mb-1 text-sm">Fecha de emisión: <span
                                            class="text-decoration-underline">{{ $fecha }}</span> <span
                                            class="text-success-main">
                                        </span></p>
                                    {{-- <p class="mb-0 text-sm">Date Due: <span
                                            class="editable text-decoration-underline">29/08/2020</span> <span
                                            class="text-success-main">
                                            <iconify-icon icon="mage:edit"></iconify-icon>
                                        </span></p> --}}
                                </div>
                                <div class="col-sm-4">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="image" class="mb-8">
                                    <p class="mb-1 text-sm">{{ $info->ubicacion }}</p>
                                    <p class="mb-0 text-sm">+591 {{ $info->contacto1 }}, {{ $info->atencion }}</p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('venta.guardar') }}" class="py-28 px-20" id="form-venta">
                            @csrf()
                            <input type="hidden" name="codigo" value="{{ $old }}">
                            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
                                <div id="cliente" style="">
                                    <h6 class="text-md">Emitir a <span class="text-muted fw-normal">(Opcional)</span></h6>
                                    <input type="text" class="form-control" placeholder="Buscar" id="cliente-search"
                                        onkeyup="buscarCliente()">
                                    <table class="text-sm text-secondary-light mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="mt-2">Cliente</span>
                                                </td>
                                                <td class="d-flex">
                                                    <input type="hidden" id="cod_cliente" name="cod_cliente">
                                                    :&nbsp;<input type="text" class="form-control"
                                                        placeholder="Nombre de cliente" id="nombre_cli" name="nombre_cli">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="mt-2">Teléfono</span>
                                                </td>
                                                <td class="d-flex">
                                                    :&nbsp;<input type="text" class="form-control"
                                                        placeholder="Numero de telefono" id="telefono" name="telefono">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="mt-2">Dirección</span>
                                                </td>
                                                <td class="d-flex">
                                                    :&nbsp;<input type="text" class="form-control"
                                                        placeholder="Dirección" id="direccion" name="direccion">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <table class="text-sm text-secondary-light">
                                        <tbody>
                                            <tr>
                                                <td>Diagnostico</td>
                                                <td class="d-flex">
                                                    :&nbsp;
                                                    <textarea class="form-control" rows="5" id="diagnostico" name="diagnostico"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-24">
                                <div class="table-responsive scroll-sm" id="form-venta">
                                    <table class="table bordered-table text-sm" id="invoice-table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-sm">#</th>
                                                <th scope="col" class="text-sm">Producto</th>
                                                <th scope="col" class="text-sm">Stock</th>
                                                <th scope="col" class="text-sm">Cantidad</th>
                                                <th scope="col" class="text-sm">Precio unitario</th>
                                                <th scope="col" class="text-sm">Precio total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div>
                                    <button type="button" id="addRow"
                                        class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                                        <iconify-icon icon="simple-line-icons:plus" class="text-xl"></iconify-icon>
                                        Agregar producto
                                    </button>
                                </div>

                                <div class="d-flex flex-wrap justify-content-between gap-3 mt-24">
                                    <div>
                                        <p class="text-sm mb-0">
                                            <span class="text-primary-light fw-semibold">
                                                Emitido por:</span>
                                            {{ Auth::user()->nombres }}
                                        </p>
                                        {{-- <p class="text-sm mb-0">Thanks for your business</p> --}}
                                    </div>
                                    <div>
                                        <table class="text-sm">
                                            <tbody>
                                                {{-- <tr>
                                                    <td class="pe-64">Subtotal:</td>
                                                    <td class="pe-16">
                                                        <span class="text-primary-light fw-semibold">$4000.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-64">Discount:</td>
                                                    <td class="pe-16">
                                                        <span class="text-primary-light fw-semibold">$0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-64 border-bottom pb-4">Tax:</td>
                                                    <td class="pe-16 border-bottom pb-4">
                                                        <span class="text-primary-light fw-semibold">0.00</span>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td class="pe-64 pt-4">
                                                        <span class="text-primary-light fw-semibold">Total:</span>
                                                    </td>
                                                    <td class="pe-16 pt-4">
                                                        <input type="hidden" id="venta-total" name="total">
                                                        <span class="text-primary-light fw-semibold">Bs. <span
                                                                id="total">0.00</span></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-64">
                                <p class="text-center text-secondary-light text-sm fw-semibold">Thank you for your
                                    purchase!</p>
                            </div>

                            <div class="d-flex flex-wrap justify-content-between align-items-end mt-64">
                                <div class="text-sm border-top d-inline-block px-12">Signature of Customer</div>
                                <div class="text-sm border-top d-inline-block px-12">Signature of Authorized</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <datalist id="productos">
        @foreach ($productos as $producto)
            <option value="{{ $producto->nombre_prod }} &nbsp;- V {{ $producto->fecha_caducidad }}"
                data-precio="{{ $producto->precio_unitario }}" data-stock="{{ $producto->stock }}"
                data-id="{{ $producto->cod_precio_compra }}"></option>
        @endforeach
    </datalist>
@endsection

@push('scripts')
    <script>
        $('#addRow').click(function() {
            const rowCount = $('#invoice-table tbody tr').length + 1;
            const newRow = `
                <tr>
                    <td>${String(rowCount).padStart(2, '0')}</td>
                    <td>
                        <button type="button" class="btn btn-outline-danger remove-row"><iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon></button>
                        <input type="hidden" id="id_${rowCount}" name="ids[]">
                        <input type="text" class="invoice-form-control producto-input" list="productos" data-row="${rowCount}" autocomplete="off" required name="productos[]" placeholder="Producto">
                    </td>
                    <td><input type="hidden" class="invoive-form-control" id="stock_total_${rowCount}" readonly><input type="number" class="invoive-form-control" id="stock_${rowCount}" readonly></td>
                    <td><input type="number" class="invoive-form-control" value="0" min="0" onchange="sumarTotal(${rowCount})" onkeyup="sumarTotal(${rowCount})" id="cantidad_${rowCount}" required name="cantidades[]" readonly></td>
                    <td><input type="number" class="invoive-form-control" value="0.00" step="0.01" id="precio_${rowCount}" onchange="sumarTotal(${rowCount})" required name="precios[]" readonly></td>
                    <td><input type="number" class="invoive-form-control precios-totales" value="0.00" step="0.10" id="precio_total_${rowCount}" required name="preciosTotales[]" readonly></td>
                </tr>
            `;
            $('#invoice-table tbody').append(newRow);

            ventaTotal()
        });

        $(document).on('input', '.producto-input', function() {
            const productoNombre = $(this).val();
            const rowId = $(this).data('row');
            const precioInput = $(`#precio_${rowId}`);
            const precioTotalInput = $(`#precio_total_${rowId}`);

            // Buscar el precio en el datalist
            const option = $(`#productos option[value="${productoNombre}"]`);
            if (option.length) {
                const precio = option.data('precio');
                const stock = option.data('stock');
                const id = option.data('id')
                precioInput.val(precio);
                precioTotalInput.val(precio);

                precioInput.removeAttr('readonly');
                $('#cantidad_' + rowId).removeAttr('readonly');
                $('#cantidad_' + rowId).val(1)
                $('#cantidad_' + rowId).attr('max', stock);
                $('#stock_total_' + rowId).val(stock);
                $('#stock_' + rowId).val(stock - 1);
                $('#id_' + rowId).val(id);
            } else {
                precioInput.val(0.00);
                precioTotalInput.val(0.00);
                $('#stock_' + rowId).val('');
            }

            ventaTotal()
        });

        function sumarTotal(row) {
            const precio = $('#precio_' + row).val()
            const cantidad = $('#cantidad_' + row).val()
            const total = precio * cantidad
            $('#precio_total_' + row).val(total.toFixed(2));

            const stock = $('#stock_' + row).val()
            const stock_total = $('#stock_total_' + row).val()
            $('#stock_' + row).val(stock_total - cantidad)

            ventaTotal()
        }

        function ventaTotal() {
            let total = 0
            $('.precios-totales').each(function() {
                const venta = parseFloat($(this).val()) || 0
                total = total + venta
            });

            $('#total').html(total.toFixed(2))
            $('#venta-total').val(total.toFixed(2))
        }

        function buscarCliente() {
            if ($('#cliente-search').val() != '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('venta.cliente') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        nombre: $('#cliente-search').val()
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);

                        if (response) {
                            $('#cod_cliente').val(response.cod_cliente)
                            $('#nombre_cli').val(response.nombre_cli)
                            $('#telefono').val(response.telefono)
                            $('#direccion').val(response.direccion)
                            $('#diagnostico').val(response.diagnostico)
                        } else {
                            $('#cod_cliente').val('')
                            $('#nombre_cli').val('')
                            $('#telefono').val('')
                            $('#direccion').val('')
                            $('#diagnostico').val('')
                        }
                    },
                    error: function(err) {
                        $('#cod_cliente').val('')
                        $('#nombre_cli').val('')
                        $('#telefono').val('')
                        $('#direccion').val('')
                        $('#diagnostico').val('')
                    }
                });
            } else {
                $('#cod_cliente').val('')
                $('#nombre_cli').val('')
                $('#telefono').val('')
                $('#direccion').val('')
                $('#diagnostico').val('')
            }
        }

        function submitVenta() {
            const rowCount = $('#invoice-table tbody tr').length
            if (rowCount > 0) {
                $('#form-venta').submit()
            }
        }

        $('#form-venta').on('keydown', function(e) {
            if (e.key === 'Enter' && !e.ctrlKey) {
                e.preventDefault();
                $('#addRow').click();
            } else if (e.key === 'Enter' && e.ctrlKey) {
                e.preventDefault();
                $('#btn-submit').click();
            }
        });
    </script>
@endpush

@extends('backend.layout.layout2')

@php
    $title = 'Agregar nueva compra';
    $subTitle = 'Nueva compra';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <form action="{{ route('compra.guardar') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-20 col-12">
                                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Producto
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <br>
                                        <input type="radio" class="form-check-input producto" id="existente"
                                            name="opt" value="existente"
                                            {{ old('opt') == 'existente' ? 'checked' : '' }} onchange="setStock()">
                                        <label for="existente">Producto existente</label>
                                        <br>
                                        <input type="radio" class="form-check-input producto" id="nuevo"
                                            name="opt" value="nuevo" {{ old('opt') == 'nuevo' ? 'checked' : '' }}
                                            onchange="setStock()">
                                        <label for="nuevo">Producto nuevo</label>
                                        <br>
                                        @error('opt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" style="display:{{ old('opt') == 'existente' ? 'flex' : 'none' }}"
                                    id="producto-existente">
                                    <div class="mb-20 col-12">
                                        <label for="cod_producto"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Producto
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <select name="cod_producto" id="cod_producto" class="form-control"
                                            onchange="setStock()">
                                            <option value="">[Producto]</option>
                                            @foreach ($productos as $prod)
                                                <option value="{{ $prod->cod_producto }}"
                                                    data-presentacion="{{ $prod->presentacion }}"
                                                    data-cantidad="{{ $prod->cantidad }}" data-precio="{{ $prod->precio }}"
                                                    data-precio-caja="{{ $prod->precio_caja }}"
                                                    {{ old('cod_producto') == $prod->cod_producto ? 'selected' : '' }}>
                                                    Bs. {{ $prod->precio }} - {{ $prod->nombre_prod }}
                                                    [{{ $prod->presentacion }} x
                                                    {{ $prod->cantidad }}]
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('cod_producto')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div class="row" style="display:{{ old('opt') == 'nuevo' ? 'flex' : 'none' }}"
                                    id="nuevo-producto">
                                    <div class="mb-20 col-md-5 col-12">
                                        <label for="nombre_prod"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Nombres
                                            <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" id="nombre_prod"
                                            placeholder="Ingrese sus nombres" name="nombre_prod"
                                            value="{{ $producto->nombre_prod ?? old('nombre_prod') }}">
                                        @error('nombre_prod')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-3 col-5">
                                        <label for="presentacion"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Presentación<span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" class="form-control radius-8" id="presentacion"
                                            placeholder="Unidad" name="presentacion"
                                            value="{{ $producto->presentacion ?? old('presentacion') }}"
                                            onkeyup="setStock()">
                                        @error('presentacion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-1 col-1 d-flex align-items-end justify-content-center">
                                        <b>x</b>
                                    </div>
                                    <div class="mb-20 col-md-3 col-5">
                                        <label for="cantidad"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Cantidad
                                            <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" id="cantidad"
                                            placeholder="Cantidad" name="cantidad"
                                            value="{{ $producto->cantidad ?? old('cantidad') }}" onkeyup="setStock()">
                                        @error('cantidad')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="precio"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Precio unidad
                                            P/Unit
                                            <span class="text-danger-600">*</span></label>
                                        <input type="number" step="0.01" min="0" class="form-control radius-8"
                                            id="precio" placeholder="Ingrese el precio en bs" name="precio"
                                            value="{{ $producto->precio ?? old('precio') }}" onkeyup="setPrecio()">
                                        @error('precio')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="precio_caja"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Precio caja
                                            <span class="text-danger-600">*</span></label>
                                        <input type="number" step="0.01" min="0"
                                            class="form-control radius-8" id="precio_caja"
                                            placeholder="Ingrese el precio de caja en bs" name="precio_caja"
                                            value="{{ $producto->precio_caja ?? old('precio_caja') }}"
                                            onchange="setMontoTotal()" onkeyup="setMontoTotal()">
                                        @error('precio_caja')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-20 col-md-6 col-12">
                                        <label for="fecha_caducidad"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Fecha caducidad
                                            <span class="text-danger-600">*</span></label>
                                        <input type="date" class="form-control radius-8" id="fecha_caducidad"
                                            name="fecha_caducidad"
                                            value="{{ $producto->fecha_caducidad ?? old('fecha_caducidad') }}">
                                        @error('fecha_caducidad')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="cod_categoria"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Categoría
                                            <span class="text-danger-600">*</span></label>
                                        <select class="form-control radius-8" id="cod_categoria" name="cod_categoria"
                                            onchange="selectCategoria()">
                                            <option value="">[ Categoría ]</option>
                                            @foreach ($categorias as $cat)
                                                <option value="{{ $cat->cod_categoria }}"
                                                    {{ old('cod_categoria') == $cat->cod_categoria ? 'selected' : '' }}>
                                                    {{ $cat->nombre_cat }}
                                                </option>
                                            @endforeach
                                            <option value="otro" {{ old('cod_categoria') == 'otro' ? 'selected' : '' }}>
                                                - Crear categoría -
                                            </option>
                                        </select>
                                        @error('cod_categoria')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12"
                                        style="display:{{ old('cod_categoria') == 'otro' ? 'block' : 'none' }};"
                                        id="otro-cat">
                                        <label for="nombre_otro_cat"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Otra categoría
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="text" class="form-control radius-8" id="nombre_otro_cat"
                                            placeholder="Ingrese el nombre de la nueva categoría" name="nombre_otro_cat"
                                            value="{{ old('nombre_otro_cat') }}">
                                        @error('nombre_otro_cat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="mb-20 col-12">
                                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Proveedor
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <br>
                                        <input type="radio" class="form-check-input proveedor" id="existente2"
                                            name="opt2" value="existente"
                                            {{ old('opt2') == 'existente' ? 'checked' : '' }}>
                                        <label for="existente2">Proveedor existente</label>
                                        <br>
                                        <input type="radio" class="form-check-input proveedor" id="nuevo2"
                                            name="opt2" value="nuevo" {{ old('opt2') == 'nuevo' ? 'checked' : '' }}>
                                        <label for="nuevo2">Proveedor nuevo</label>
                                        <br>
                                        @error('opt2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" style="display:{{ old('opt2') == 'nuevo' ? 'flex' : 'none' }}"
                                    id="nuevo-proveedor">
                                    <div class="mb-20 col-12">
                                        <label for="nombre_prov"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Nombres
                                            <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" id="nombre_prov"
                                            placeholder="Ingrese sus nombres" name="nombre_prov"
                                            value="{{ $proveedor->nombre_prov ?? old('nombre_prov') }}">
                                        @error('nombre_prov')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="telefono"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Teléfono
                                        </label>
                                        <input type="text" class="form-control radius-8" id="telefono"
                                            placeholder="Ingrese su telefono" name="telefono"
                                            value="{{ $proveedor->telefono ?? old('telefono') }}">
                                        @error('telefono')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="direccion"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Dirección
                                        </label>
                                        <input type="text" class="form-control radius-8" id="direccion"
                                            placeholder="Ingrese su direccion" name="direccion"
                                            value="{{ $proveedor->direccion ?? old('direccion') }}">
                                        @error('direccion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div class="row" style="display:{{ old('opt2') == 'existente' ? 'flex' : 'none' }}"
                                    id="proveedor-existente">
                                    <div class="mb-20 col-12">
                                        <label for="cod_proveedor"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Proveedor
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <select name="cod_proveedor" id="cod_proveedor" class="form-control">
                                            <option value="">[Proveedor]</option>
                                            @foreach ($proveedores as $pro)
                                                <option value="{{ $pro->cod_proveedor }}">{{ $pro->nombre_prov }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('cod_proveedor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="mb-20 col-md-4 col-12">
                                        <label for="cantidad_compra"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Cantidad
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="number" step="1" min="1"
                                            class="form-control radius-8" id="cantidad_compra" placeholder="Cantidad"
                                            name="cantidad_compra" value="{{ old('cantidad_compra') }}"
                                            onkeyup="setStock()" onchange="setStock()">
                                        @error('cantidad_compra')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-4 col-12">
                                        <label for="monto_total"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Monto total
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="number" step="0.01" min="0.01"
                                            class="form-control radius-8" id="monto_total"
                                            placeholder="Monto total en bs" name="monto_total"
                                            value="{{ old('monto_total') }}">
                                        @error('monto_total')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-4 col-12">
                                        <label for="precio_unitario"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Precio comercial - P/Unit
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="number" step="0.01" min="0.01"
                                            class="form-control radius-8" id="precio_unitario" placeholder="P/Unit"
                                            name="precio_unitario" value="{{ old('precio_unitario') }}">
                                        @error('precio_unitario')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="stock"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Cantidad (Stock)
                                            <span class="text-danger-600">*</span>
                                        </label>
                                        <input type="hidden" name="stock" value="{{ old('stock') }}"
                                            id="stock">
                                        <input type="text" class="form-control radius-8" id="stockTexto"
                                            placeholder="Stock" value="{{ old('stock') }}">
                                        @error('stock')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-20 col-md-6 col-12">
                                        <label for="fecha_caducidad"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">
                                            Fecha de caducidad
                                            <span class="text-danger-600">* (Importante)</span>
                                        </label>
                                        <input type="month" class="form-control radius-8" id="fecha_caducidad"
                                            name="fecha_caducidad" value="{{ old('fecha_caducidad') }}">
                                        @error('fecha_caducidad')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="{{ route('producto') }}"
                                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                            Cancelar
                                        </a>
                                        <button type="submit"
                                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Comprar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function selectCategoria() {
            var categoria = document.getElementById('cod_categoria').value;
            if (categoria === 'otro') {
                document.getElementById('otro-cat').style.display = 'block';
            } else {
                document.getElementById('otro-cat').style.display = 'none';
            }
        }

        $('.producto').on('change', function() {
            const opcion = $(this)[0].value
            if (opcion == 'nuevo') {
                $('#nuevo-producto').css('display', 'flex')
                $('#producto-existente').css('display', 'none')
            } else {
                $('#producto-existente').css('display', 'flex')
                $('#nuevo-producto').css('display', 'none')
            }
        })

        $('.proveedor').on('change', function() {
            const opcion = $(this)[0].value
            if (opcion == 'nuevo') {
                $('#nuevo-proveedor').css('display', 'flex')
                $('#proveedor-existente').css('display', 'none')
            } else {
                $('#proveedor-existente').css('display', 'flex')
                $('#nuevo-proveedor').css('display', 'none')
            }
        })

        function setStock() {
            const nu = $('#nuevo').is(':checked');

            const cantidadCompra = $('#cantidad_compra').val();

            let presentacion = 0;
            let cantidad = 0;
            let unidad = '';

            if (nu) {
                const presentacionTexto = $('#presentacion').val();
                const cantidadTexto = $('#cantidad').val();

                const pm = presentacionTexto ? presentacionTexto.match(/\d+/) : null;
                presentacion = pm ? parseInt(pm[0], 10) : 1;

                const cantidadTextoString = String(cantidadTexto || "");

                const cm = cantidadTextoString.match(/\d+/);
                cantidad = cm ? parseInt(cm[0], 10) : 1;

                if (cm) {
                    const indiceFinalNumero = cm.index + cm[0].length;
                    const textoDespues = cantidadTextoString.slice(indiceFinalNumero).trim();
                    unidad = textoDespues || null;
                }
            } else {

                const presentacionTexto = $('#cod_producto option:selected').data('presentacion');
                const cantidadTexto = $('#cod_producto option:selected').data('cantidad');

                const cantidadTextoString = String(cantidadTexto || "");

                const pm = presentacionTexto ? presentacionTexto.match(/\d+/) : null;
                presentacion = pm ? parseInt(pm[0], 10) : 1;

                const cm = cantidadTextoString.match(/\d+/);
                cantidad = cm ? parseInt(cm[0], 10) : 1;

                if (cm) {
                    const indiceFinalNumero = cm.index + cm[0].length;
                    const textoDespues = cantidadTextoString.slice(indiceFinalNumero).trim();
                    unidad = textoDespues || null;
                }
            }


            if (cantidadCompra && presentacion && cantidad) {
                const stock = (presentacion * cantidad) * parseInt(cantidadCompra, 10);
                $('#stockTexto').val(`${stock} ${unidad ?? ''}`);
                $('#stock').val(stock);
            } else {
                $('#stock').val('');
            }

            setPrecio();
        }


        function setPrecio() {
            const nu = $('#nuevo').is(':checked')

            let precio_unitario = 0
            if (nu) {
                const precio = $('#precio').val()
                precio_unitario = precio ? parseFloat(precio, 2) : 0
            } else {
                const precio = $('#cod_producto option:selected').data('precio')
                precio_unitario = precio ? parseFloat(precio, 2) : 0
            }

            $('#precio_unitario').val(precio_unitario.toFixed(2));

            setMontoTotal()
        }

        function setMontoTotal() {
            const nu = $('#nuevo').is(':checked')

            let monto_total = 0
            if (nu) {
                const precio = $('#precio_caja').val()
                const cantidad = $('#cantidad_compra').val()

                monto_total = precio * cantidad ? parseFloat(precio * cantidad, 2) : 0
            } else {
                const precio = $('#cod_producto option:selected').data('precio-caja')
                const cantidad = $('#cantidad_compra').val()

                monto_total = precio * cantidad ? parseFloat(precio * cantidad, 2) : 0
            }

            $('#monto_total').val(parseFloat(monto_total, 2))
        }
    </script>
@endpush

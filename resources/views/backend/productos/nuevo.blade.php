@extends('backend.layout.layout2')

@php
    $title = 'Agregar nuevo producto';
    $subTitle = 'Nuevo producto';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <form
                            action="{{ isset($producto) ? route('producto.actualizar', $producto->cod_producto) : route('producto.guardar') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($producto))
                                @method('PUT')
                            @endif
                            <div class="card-body row">
                                <div class="mb-20 col-12">
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
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="precio"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Precio
                                        <span class="text-danger-600">*</span></label>
                                    <input type="number" step="0.10" min="0" class="form-control radius-8" id="precio"
                                        placeholder="Ingrese el precio en bs" name="precio"
                                        value="{{ $producto->precio ?? old('precio') }}">
                                    @error('precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="stock"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Stock
                                        <span class="text-danger-600">*</span></label>
                                    <input type="number" class="form-control radius-8" id="stock"
                                        placeholder="Ingrese la cantidad" name="stock"
                                        value="{{ $producto->stock ?? old('stock') }}">
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="fecha_caducidad"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Fecha caducidad
                                        <span class="text-danger-600">*</span></label>
                                    <input type="date" class="form-control radius-8" id="fecha_caducidad"
                                        name="fecha_caducidad"
                                        value="{{ $producto->fecha_caducidad ?? old('fecha_caducidad') }}">
                                    @error('fecha_caducidad')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="cod_categoria"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Categoría
                                        <span class="text-danger-600">*</span></label>
                                    <select class="form-control radius-8" id="cod_categoria" name="cod_categoria">
                                        <option value="">[ Categoría ]</option>
                                        @foreach ($categorias as $cat)
                                            <option value="{{ $cat->cod_categoria }}">
                                                {{ $cat->nombre_cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cod_categoria')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('producto') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Cancelar
                                    </a>
                                    @if (isset($producto))
                                        <button type="submit"
                                            class="btn btn-warning border border-warning-600 text-md px-56 py-12 radius-8">
                                            Actualizar
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Guardar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

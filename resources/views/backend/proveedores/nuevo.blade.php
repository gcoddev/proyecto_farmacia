@extends('backend.layout.layout2')

@php
    $title = 'Agregar nuevo proveedor';
    $subTitle = 'Nuevo proveedor';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <form
                            action="{{ isset($proveedor) ? route('proveedor.actualizar', $proveedor->cod_proveedor) : route('proveedor.guardar') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($proveedor))
                                @method('PUT')
                            @endif
                            <div class="card-body row">
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
                                    <input type="number" class="form-control radius-8" id="telefono"
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
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('proveedor') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Cancelar
                                    </a>
                                    @if (isset($proveedor))
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

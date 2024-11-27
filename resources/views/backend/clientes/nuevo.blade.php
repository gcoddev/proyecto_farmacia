@extends('backend.layout.layout2')

@php
    $title = 'Agregar nuevo cliente';
    $subTitle = 'Nuevo cliente';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <form
                            action="{{ isset($cliente) ? route('cliente.actualizar', $cliente->cod_cliente) : route('cliente.guardar') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($cliente))
                                @method('PUT')
                            @endif
                            <div class="card-body row">
                                <div class="mb-20 col-12">
                                    <label for="nombre_cli"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nombres
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="nombre_cli"
                                        placeholder="Ingrese sus nombres" name="nombre_cli"
                                        value="{{ $cliente->nombre_cli ?? old('nombre_cli') }}">
                                    @error('nombre_cli')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-12">
                                    <label for="diagnostico"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Diagnostico
                                        <span class="text-danger-600">*</span></label>
                                    <textarea class="form-control radius-8" id="diagnostico" placeholder="Ingrese diagnostico" name="diagnostico">{{ $cliente->diagnostico ?? old('diagnostico') }}</textarea>
                                    @error('diagnostico')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="telefono"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Teléfono
                                    </label>
                                    <input type="text" class="form-control radius-8" id="telefono"
                                        placeholder="Ingrese su telefono" name="telefono"
                                        value="{{ $cliente->telefono ?? old('telefono') }}">
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
                                        value="{{ $cliente->direccion ?? old('direccion') }}">
                                    @error('direccion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('cliente') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Cancelar
                                    </a>
                                    @if (isset($cliente))
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

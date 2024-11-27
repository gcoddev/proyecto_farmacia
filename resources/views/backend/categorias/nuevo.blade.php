@extends('backend.layout.layout2')

@php
    $title = 'Agregar nueva categoría';
    $subTitle = 'Nueva categoria';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <form
                            action="{{ isset($categoria) ? route('categoria.actualizar', $categoria->cod_categoria) : route('categoria.guardar') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($categoria))
                                @method('PUT')
                            @endif
                            <div class="card-body row">
                                <div class="mb-20 col-12">
                                    <label for="nombre_cat"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nombres
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="nombre_cat"
                                        placeholder="Ingrese sus nombres" name="nombre_cat"
                                        value="{{ $categoria->nombre_cat ?? old('nombre_cat') }}">
                                    @error('nombre_cat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-12">
                                    <label for="descripcion"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Descripción
                                    </label>
                                    <input type="text" class="form-control radius-8" id="descripcion"
                                        placeholder="Ingrese su descripcion" name="descripcion"
                                        value="{{ $categoria->descripcion ?? old('descripcion') }}">
                                    @error('descripcion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('categoria') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Cancelar
                                    </a>
                                    @if (isset($categoria))
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

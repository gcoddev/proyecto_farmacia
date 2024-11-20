@extends('backend.layout.layout2')

@php
    $title = 'Agregar nuevo usuario';
    $subTitle = 'Nuevo usuario';
@endphp

@section('content')
    <div class="card h-100 p-0 radius-12">
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <form
                            action="{{ isset($usuario) ? route('usuario.actualizar', $usuario->id) : route('usuario.guardar') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($usuario))
                                @method('PUT')
                            @endif
                            <div class="card-body row">
                                <h6 class="text-md text-primary-light mb-16 col-12">Imagen del perfil</h6>
                                <div class="mb-24 mt-16 col-12">
                                    <div class="avatar-upload">
                                        <div
                                            class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" hidden
                                                onchange="viewImagen()" name="image">
                                            <label for="imageUpload"
                                                class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                            </label>
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="avatar-preview">
                                            @if (isset($usuario->imagen))
                                                <div id="imagePreview"
                                                    style="background-image:url({{ asset('storage/perfil/' . $usuario->imagen) }});">
                                                </div>
                                            @else
                                                <div id="imagePreview"
                                                    style="background-image:url({{ asset('assets/images/no-image.jpg') }});">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload Image End -->
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="nombres"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nombres
                                        <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="nombres"
                                        placeholder="Ingrese sus nombres" name="nombres"
                                        value="{{ $usuario->nombres ?? old('nombres') }}">
                                    @error('nombres')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="apellidos"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Apellidos <span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="apellidos"
                                        placeholder="Ingrese sus apellidos" name="apellidos"
                                        value="{{ $usuario->apellidos ?? old('apellidos') }}">
                                    @error('apellidos')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="email"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Correo</label>
                                    <input type="text" class="form-control radius-8" id="email"
                                        placeholder="Ingrese su correo" name="email"
                                        value="{{ $usuario->email ?? old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="username"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nombre
                                        de
                                        usuario <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="username"
                                        placeholder="Ingrese el nombre de usuario" name="username"
                                        value="{{ $usuario->username ?? old('username') }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="password" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Nueva contraseña
                                        @if (!isset($usuario))
                                            <span class="text-danger-600">*</span>
                                        @endif
                                    </label>
                                    <input type="password" class="form-control radius-8" id="password"
                                        placeholder="Ingrese la nueva contraseña" name="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="password2" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Confirmar contraseña
                                        @if (!isset($usuario))
                                            <span class="text-danger-600">*</span>
                                        @endif
                                    </label>
                                    <input type="password" class="form-control radius-8" id="password2"
                                        placeholder="Ingrese nuevamente la contraseña" name="password2">
                                    @error('password2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if (isset($usuario) && $usuario->id != 1)
                                    <div class="mb-20">
                                        <label for="estado"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Estado <span
                                                class="text-danger-600">*</span> </label>
                                        <select class="form-control radius-8 form-select" id="estado" name="estado">
                                            <option value="ACTIVO" {{ $usuario->estado == 'ACTIVO' ? 'selected' : '' }}>
                                                ACTIVO
                                            </option>
                                            <option value="INACTIVO"
                                                {{ $usuario->estado == 'INACTIVO' ? 'selected' : '' }}>
                                                INACTIVO
                                            </option>
                                        </select>
                                    </div>
                                @endif
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('usuario') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Cancelar
                                    </a>
                                    @if (isset($usuario))
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

@push('scripts')
    <script>
        function viewImagen() {
            var file = document.getElementById('imageUpload').files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById('imagePreview').style.backgroundImage = 'url(' + reader.result + ')';
                document.getElementById('imagePreview').style.backgroundSize = 'cover';
                document.getElementById('imagePreview').style.backgroundPosition = 'center';
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush

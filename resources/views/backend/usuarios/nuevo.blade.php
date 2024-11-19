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
                        <div class="card-body">
                            <h6 class="text-md text-primary-light mb-16">Imagen del perfil</h6>

                            <!-- Upload Image Start -->
                            <div class="mb-24 mt-16">
                                <div class="avatar-upload">
                                    <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden
                                            onchange="viewImagen()" name="image">
                                        <label for="imageUpload"
                                            class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                            <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                        </label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image:url({{ asset('assets/images/no-image.jpg') }});"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload Image End -->

                            <form action="#" class="row">
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="nombres"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nombres <span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="nombres"
                                        placeholder="Ingrese sus nombres" name="nombres">
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="apellidos"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Apellidos <span
                                            class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="apellidos"
                                        placeholder="Ingrese sus apellidos" name="apellidos">
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="email"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Correo</label>
                                    <input type="email" class="form-control radius-8" id="email"
                                        placeholder="Ingrese su correo" name="email">
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="username"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nombre de
                                        usuario <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="username"
                                        placeholder="Ingrese el nombre de usuario" name="username">
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="password"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Nueva
                                        contraseña <span class="text-danger-600">*</span></label>
                                    <input type="password" class="form-control radius-8" id="password"
                                        placeholder="Ingrese la nueva contraseña" name="password">
                                </div>
                                <div class="mb-20 col-md-6 col-12">
                                    <label for="password2"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmar
                                        contraseña <span class="text-danger-600">*</span></label>
                                    <input type="password2" class="form-control radius-8" id="password2"
                                        placeholder="Ingrese nuevamente la contraseña" name="password2">
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <a href="{{ route('admin.usuario') }}"
                                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                        Cancelar
                                    </a>
                                    <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
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

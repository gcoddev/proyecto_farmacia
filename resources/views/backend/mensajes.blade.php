@php
    $title = 'Alerts';
    $subTitle = 'Components / Alerts';
    $script = '<script>
        $(".remove-button").on("click", function() {
            $(this).closest(".alert").addClass("d-none");
        });
    </script>';

@endphp

@if (session('message'))
    <div class="alert alert-success bg-success-100 text-success-600 border-success-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between"
        role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
            {{ session('message') }}
        </div>
        <button class="remove-button text-success-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if (session('alert'))
    <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between"
        role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="material-symbols:warning" class="icon text-xl"></iconify-icon>
            {{ session('alert') }}
        </div>
        <button class="remove-button text-warning-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-3 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between"
            role="alert">
            <div class="d-flex align-items-center gap-2">
                <iconify-icon icon="material-symbols:error" class="icon text-xl"></iconify-icon>
                {{ $error }}
            </div>
            <button class="remove-button text-danger-600 text-xxl line-height-1">
                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
            </button>
        </div>
    @endforeach
@endif

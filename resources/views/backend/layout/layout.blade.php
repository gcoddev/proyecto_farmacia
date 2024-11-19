<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

{{-- <x-head /> --}}
@include('backend.layout.partial.head')

<body>

    <!-- ..::  header area start ::.. -->
    {{-- <x-sidebar /> --}}
    @include('backend.layout.partial.sidebar')
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        {{-- <x-navbar /> --}}
        @include('backend.layout.partial.navbar')
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            <!-- ..::  breadcrumb  start ::.. -->
            {{-- <x-breadcrumb title='{{ $title }}' subTitle='{{ $subTitle }}' /> --}}
            @include('backend.layout.partial.breadcrumb', ['title' => $title, 'subTitle' => $subTitle])
            <!-- ..::  header area end ::.. -->

            @yield('content')

        </div>
        <!-- ..::  footer  start ::.. -->
        {{-- <x-footer /> --}}
        @include('backend.layout.partial.footer')
        <!-- ..::  footer area end ::.. -->

    </main>

    <!-- ..::  scripts  start ::.. -->
    {{-- <x-scripts script="{{ isset($script) ? $script : '' }}" /> --}}
    @include('backend.layout.partial.scripts', ['script' => $script ?? ''])
    <!-- ..::  scripts  end ::.. -->

</body>

</html>

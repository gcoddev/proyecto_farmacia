<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

{{-- <x-head /> --}}
@include('template.components.head')

<body>

    <!-- ..::  header area start ::.. -->
    {{-- <x-sidebar /> --}}
    @include('template.components.sidebar')
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        {{-- <x-navbar /> --}}
        @include('template.components.navbar')
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            <!-- ..::  breadcrumb  start ::.. -->
            {{-- <x-breadcrumb title='{{ $title }}' subTitle='{{ $subTitle }}' /> --}}
            @include('template.components.breadcrumb', ['title' => $title, 'subTitle' => $subTitle])
            <!-- ..::  header area end ::.. -->

            @yield('content')

        </div>
        <!-- ..::  footer  start ::.. -->
        {{-- <x-footer /> --}}
        @include('template.components.footer')
        <!-- ..::  footer area end ::.. -->

    </main>

    <!-- ..::  scripts  start ::.. -->
    {{-- <x-scripts script="{{ isset($script) ? $script : '' }}" /> --}}
    @include('template.components.scripts', ['script' => $script ?? ''])
    <!-- ..::  scripts  end ::.. -->

</body>

</html>

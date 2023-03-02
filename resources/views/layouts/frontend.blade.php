<!doctype html>
<html lang="en">

<head>
    @include('partials.frontend.head')
    <title>{{ $title ?? config('app.name') }}</title>
    @stack('styles')
</head>

<body class="bg-light">
    <div id="custom-target"></div>
    <!-- Preloader -->
    <div id="preloader">
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100%" id="loading-wrapper">
            <div id="loading-animation"></div>
            <span>Loading...</span>
        </div>
    </div>
    @include('partials.frontend.nav', ['disableHero' => $disableHero ?? 0])


    @yield('content')


    
    
    @include('partials.frontend.chat')
    
    @if (!isset($disableFooter))
        @include('partials.frontend.footer')
    @endif
    <!-- Optional JavaScript; choose one of the two! -->


    <script>
        const id = '{{ auth()->id() }}';
    </script>
    @include('partials.frontend.script')
    @stack('scripts')
</body>

</html>
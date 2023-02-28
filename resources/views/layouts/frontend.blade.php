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
    
    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop() > 40) {
                $('.navbar-hero').removeClass('bg-transparent')
                $('.navbar-hero').addClass('bg-white shadow')
                $('.navbar-hero').removeClass('navbar-dark')
                $('.navbar-hero').addClass('navbar-light')
                $('.navbar-hero').find('#navbarSupportedContent').removeClass('font-weight-bold')
            } else {
                $('.navbar-hero').removeClass('bg-white shadow')
                $('.navbar-hero').addClass('bg-transparent')
                $('.navbar-hero').removeClass('navbar-light')
                $('.navbar-hero').addClass('navbar-dark')
                $('.navbar-hero').find('#navbarSupportedContent').addClass('font-weight-bold')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
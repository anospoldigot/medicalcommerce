<!doctype html>
<html lang="en">

<head>
    @include('partials.frontend.head')
    <title>{{ $title ?? config('app.name') }}</title>
    @stack('styles')
</head>

<body>
    @include('partials.frontend.nav', ['disableHero' => $disableHero ?? 0])


    @yield('content')


    
    
    @include('partials.frontend.chat')
    @include('partials.frontend.footer')
    <!-- Optional JavaScript; choose one of the two! -->

    @include('partials.frontend.script')

    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop() > 40) {
                $('.navbar-hero').removeClass('bg-transparent')
                $('.navbar-hero').addClass('bg-white shadow')
            } else {
                $('.navbar-hero').removeClass('bg-white shadow')
                $('.navbar-hero').addClass('bg-transparent')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
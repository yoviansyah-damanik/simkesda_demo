<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.partials.header')

<body>
    @include('partials.loading')

    @include('sweetalert::alert')
    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

    @include('frontend.partials.js')
</body>

</html>

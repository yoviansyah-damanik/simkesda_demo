<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('auth.partials.header')

<body>
    @include('partials.loading')
    @include('sweetalert::alert')

    @yield('content')

    @include('auth.partials.js')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

@include('backend.partials.header')

<body>
    <div class="preloader">
        <span></span>
    </div>

    @include('sweetalert::alert')
    <div class="layer"></div>
    <!-- ! Body -->
    <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
    <div class="page-flex">
        @include('backend.partials.sidebar')

        <div class="main-wrapper">
            @include('backend.partials.navbar')
            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                @yield('container')
            </main>
            @include('backend.partials.footer')
        </div>
    </div>
    @include('backend.partials.js')
</body>

</html>

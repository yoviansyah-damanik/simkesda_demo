<nav class="navbar sticky-top shadow-sm">
    <div class="container flex-nowrap">
        <a class="navbar-brand ms-3 me-0 ms-md-0 order-1 order-md-0" href="{{ route('homepage') }}">
            <img src="{{ asset('images/logo-dinkes-simkesda.png') }}" alt="Logo Dinkes">
        </a>
        <div class="ms-auto">
            {{-- <a href="https://dinkes.tapselkab.go.id">
                Situs Resmi Dinas Kesehatan Tapanuli Selatan
            </a> --}}
            <button class="btn btn-primary btn-menu px-md-4 mx-auto mx-md-0 order-0 order-md-1" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#navbarMenu" aria-controls="navbarMenu">
                <i class="fas fa-bars"></i>
                <span class="d-none d-md-inline-block ms-2">
                    Menu
                </span>
            </button>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="navbarMenu"
    aria-labelledby="navbarMenuLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <img src="{{ asset('images/logo-dinkes-simkesda.png') }}" alt="Logo {{ config('app.name') }}"
            class="offcanvas-logo">
    </div>
    <div class="offcanvas-body position-relative">
        {{-- TOP --}}
        <div class="navbar-menu-links">
            <ul>
                @foreach (DataHelper::get_frontend_menus() as $menu)
                    <li {{ Request::routeIs($menu['route']) ? 'class=active' : '' }}>
                        <a href="{{ $menu['href'] }}">
                            <span>
                                <i class="{{ $menu['icon'] }}"></i>
                                {{ $menu['title'] }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="mt-5">
                @auth
                    <p class="text-center">
                        Halo, {{ Auth::user()->name }}!
                    </p>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <span>
                                    <i class="fas fa-gauge"></i>
                                    Dasbor
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.account') }}">
                                <span>
                                    <i class="fas fa-user"></i>
                                    Pengaturan Akun
                                </span>
                            </a>
                        </li>
                        <li>
                            <form class="d-block" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="w-100 border-0 bg-transparent" type="submit">
                                    <span>
                                        <i class="fas fa-sign-out"></i>
                                        Keluar
                                    </span>
                                </button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a class="btn btn-danger btn-login d-block rounded-pill" href="{{ route('login') }}">
                        <i class="fas fa-sign-in"></i>
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>

            {{-- BOTTOM --}}
            <div class="bg-white border-top border-1 position-absolute bottom-0 start-0 end-0 py-1 py-md-3">
                <div class="small text-muted text-center">
                    {{ config('app.name') }} <br />
                    {{ config('app.unit_name') }} <br />
                    Versi {{ config('app.version') }}
                </div>
            </div>
        </div>
    </div>
</div>

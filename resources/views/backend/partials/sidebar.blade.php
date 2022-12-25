<!-- ! Sidebar -->
<aside class="sidebar shadow">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="{{ route('dashboard') }}" class="logo-wrapper" title="Dasbor">
                <img src="{{ asset('images/logo-dinkes-2.png') }}" alt="Logo Dinkes" class="logo-img">
                <img src="{{ asset('images/logo-dinkes-dark.png') }}" alt="Logo Dinkes" class="logo-img dark">
                <div class="text-white text-center my-2 w-100">
                    <div class="fw-semibold mb-1">SIMKESDA</div>
                    <small>
                        Sistem Informasi Kesehatan Daerah
                    </small>
                </div>
            </a>
            <button class="sidebar-toggle transparent-btn mx-auto my-2" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a href="{{ route('dashboard') }}" @if (Request::routeIs('dashboard')) class="active" @endif>
                        <i class="icon home"></i>
                        Dasbor
                    </a>
                </li>
            </ul>

            @foreach (DataHelper::get_backend_sidebar_menus() as $sidebar)
                <span class="system-menu__title">{{ $sidebar['title'] }}</span>
                @if (count($sidebar['menus']) > 0)
                    <ul class="sidebar-body-menu">
                        @foreach ($sidebar['menus'] as $menu)
                            <li>
                                @if (count($menu['childs']) > 0)
                                    <a class="show-cat-btn" href="{{ $menu['link'] }}">
                                        <span class="{{ $menu['icon'] }}" aria-hidden="true"></span>
                                        {{ $menu['title'] }}
                                        <span
                                            class="category__btn transparent-btn rotate @if (Request::routeIs($menu['route'])) rotated @endif"
                                            title="Open list">
                                            <span class="icon arrow-down" aria-hidden="true"></span>
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ $menu['link'] }}"
                                        @if (Request::routeIs($menu['route'])) class="active" @endif>
                                        <span class="{{ $menu['icon'] }}" aria-hidden="true"></span>
                                        {{ $menu['title'] }}
                                    </a>
                                @endif
                                @if (count($menu['childs']) > 0)
                                    <ul class="cat-sub-menu @if (Request::routeIs($menu['route'])) visible @endif">
                                        @foreach ($menu['childs'] as $child)
                                            <li>
                                                <a href="{{ $child['link'] }}"
                                                    @if (Request::routeIs($child['route'])) class="active" @endif>
                                                    <span class="{{ $child['icon'] }}" aria-hidden="true"></span>
                                                    {{ $child['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach

        </div>
    </div>
    {{-- <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture>
                    <source srcset="/images/avatar/avatar-illustrated-01.webp" type="image/webp"><img
                        src="/images/avatar/avatar-illustrated-01.png" alt="User name">
                </picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">{{ Auth::user()->name }}</span>
                <span class="sidebar-user__subtitle">{{ Auth::user()->role_name }}</span>
            </div>
        </a>
    </div> --}}
</aside>

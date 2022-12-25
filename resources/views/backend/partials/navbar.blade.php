<!-- ! Main nav -->
<nav class="main-nav--bg">
    <div class="container main-nav">
        <div class="main-nav-start">
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle--gray" aria-hidden="true"></span>
            </button>
        </div>
        <div class="main-nav-end">
            <button class="theme-switcher gray-circle-btn" type="button" title="Ganti Tema">
                <span class="sr-only">Ganti Tema</span>
                <i class="sun-icon far fa-sun text-black-50"></i>
                <i class="moon-icon far fa-moon"></i>
            </button>
            <div class="nav-user-wrapper">
                <button class="nav-user-btn dropdown-btn" title="My profile" type="button">
                    <span class="sr-only">My profile</span>
                    <span class="nav-user-img">
                        <picture>
                            <source srcset="{{ asset('images/avatar/avatar-illustrated-02.webp') }}" type="image/webp">
                            <img src="{{ asset('images/avatar/avatar-illustrated-02.png') }}" alt="User name">
                        </picture>
                    </span>
                    <div class="user-field">
                        <div class="username">{{ Auth::user()->name }}</div>
                        <div class="role">{{ Auth::user()->role_name }}</div>
                    </div>
                    <i class="ms-2 fas fa-chevron-down" aria-hidden="true"></i>
                </button>
                <ul class="users-item-dropdown nav-user-dropdown dropdown">
                    <li>
                        <a href="{{ route('homepage') }}">
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.account') }}">
                            <span>Pengaturan Akun</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn-logout">
                                <span>Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

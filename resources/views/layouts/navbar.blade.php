<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="{{ asset('assets/img/Telkomsel_Logo.png') }}" alt="Logo">
            <span style="width:1px;height:24px;background:#000000;margin:0 12px;display:inline-block;"></span>
            <img src="{{ asset('assets/img/logo_the_communal.png') }}" alt="Logo">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('home') }}#team">Our Program</a></li>
                <li><a href="{{ route('blogs', ['id' => 1]) }}">Blogs</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-flex gap-2">
            @if (Auth::check())
            <a href="/dashboard/home" class="btn btn-primary">Home</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>
            @else
            <a href="/login" class="btn btn-primary">Login</a>
            <a href="/register" class="btn btn-primary">Register</a>
            @endif
        </div>

    </div>
</header>

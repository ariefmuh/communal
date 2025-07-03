<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/logo.png')}}" alt="">
        {{-- <h1 class="sitename">Invent</h1><span>.</span> --}}
        </a>

        <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="{{ route('home')}}" class="{{ Route::currentRouteName() == 'home' ? 'active' : ''}}">Home</a></li>
            <li><a href="#team">Our Program</a></li>
            {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#">Deep Dropdown 1</a></li>
                    <li><a href="#">Deep Dropdown 2</a></li>
                    <li><a href="#">Deep Dropdown 3</a></li>
                    <li><a href="#">Deep Dropdown 4</a></li>
                    <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
            </ul>
            </li> --}}
            <li><a href="{{ route('blogs', ['id' => 1])}}">Blogs</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div>
            @if (Auth::check())
                <div class="row">
                    @if (Auth::user()->role == 'admin')

                    @endif
                    <div class="col-6">
                        <button class="btn btn-getstarted" href="/dashboard">Home</button>
                    </div>
                    <div class="col-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="color: white;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a class="btn-getstarted" href="/login">Login</a>
                <a class="btn-getstarted" href="/register">Register</a>
            @endif
        </div>
    </div>
</header>

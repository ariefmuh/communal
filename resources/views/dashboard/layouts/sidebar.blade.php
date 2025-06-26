<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/img/logo.png')}}" class="brand-image" style="opacity: .8">
        <span style="color:transparent;">a</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item @if (Route::currentRouteName() == 'dashboard.home') active @endif">
                    <a href="{{ route('dashboard.home') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.home') active @endif">
                        <i class="fa-solid fa-house nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item @if (Route::currentRouteName() == 'dashboard.request') active @endif">
                    <a href="{{ route('dashboard.request') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.request') active @endif">
                        <i class="fa-solid fa-house nav-icon"></i>
                        <p>Request</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item @if (Route::currentRouteName() == 'dashboard.blog') active @endif">
                    <a href="{{ route('dashboard.blog') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard.blog') active @endif">
                        <i class="fa-solid fa-house nav-icon"></i>
                        <p>Blog</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

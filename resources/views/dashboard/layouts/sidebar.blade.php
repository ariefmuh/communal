@php
    $userRole = Auth::user()->role;

    // Define permissions for each role
    $permissions = [
        'superuser' => ['home', 'homepage', 'request', 'blog', 'programs', 'members', 'quiz', 'gallery', 'programs_management', 'members_management'],
        'Team Leader' => ['home', 'programs', 'members', 'quiz', 'gallery'],
        'guest' => ['home', 'request']
    ];

    // Define all menu items
    $menuItems = [
        'home' => [
            'route' => 'dashboard.home',
            'icon' => 'fa-solid fa-house',
            'title' => 'Home',
            'type' => 'single'
        ],
        'homepage' => [
            'route' => 'dashboard.homepage',
            'icon' => 'fa-solid fa-globe',
            'title' => 'Homepage Management',
            'type' => 'single'
        ],
        'request' => [
            'route' => 'dashboard.request',
            'icon' => 'fa-solid fa-file-text',
            'title' => 'Requests',
            'type' => 'single',
            // 'badge' => $userRole == 'guest' ? 'My Requests' : null
        ],
        'programs' => [
            'route' => 'dashboard.programs',
            'icon' => 'fa-solid fa-calendar-days',
            'title' => 'Programs',
            'type' => 'single'
        ],
        'members' => [
            'route' => 'dashboard.members',
            'icon' => 'fa-solid fa-users',
            'title' => 'Team Members',
            'type' => 'single'
        ],
        'quiz' => [
            'route' => 'dashboard.quizzes',
            'icon' => 'fa-solid fa-clipboard-list',
            'title' => 'Quiz',
            'type' => 'single'
        ],
        'gallery' => [
            'route' => 'dashboard.gallery',
            'icon' => 'fa-solid fa-images',
            'title' => 'Gallery',
            'type' => 'single'
        ],
        'blog' => [
            'route' => 'dashboard.blog',
            'icon' => 'fa-solid fa-blog',
            'title' => 'Blog',
            'type' => 'single'
        ]
    ];

    $allowedMenuItems = array_filter($menuItems, function($key) use ($permissions, $userRole) {
        return in_array($key, $permissions[$userRole] ?? []);
    }, ARRAY_FILTER_USE_KEY);

    if (!function_exists('isRouteActive')) {
        function isRouteActive($route, $children = null) {
            if ($children) {
                foreach ($children as $child) {
                    if (Route::currentRouteName() == $child['route']) {
                        return true;
                    }
                }
                return false;
            }
            return Route::currentRouteName() == $route;
        }
    }

    if (!function_exists('isDropdownOpen')) {
        function isDropdownOpen($children) {
            foreach ($children as $child) {
                if (Route::currentRouteName() == $child['route']) {
                    return true;
                }
            }
            return false;
        }
    }
@endphp

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
                @foreach($allowedMenuItems as $key => $item)
                    @if($item['type'] == 'single')
                        <li class="nav-item @if(isRouteActive($item['route'])) active @endif">
                            <a href="{{ route($item['route']) }}"
                               class="nav-link @if(isRouteActive($item['route'])) active @endif">
                                <i class="{{ $item['icon'] }} nav-icon"></i>
                                <p>
                                    {{ $item['title'] }}
                                    @if(isset($item['badge']))
                                        <span class="badge badge-info right">{{ $item['badge'] }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                    @elseif($item['type'] == 'dropdown')
                        <li class="nav-item @if(isDropdownOpen($item['children'])) menu-open @endif has-treeview">
                            <a href="#" class="nav-link @if(isRouteActive(null, $item['children'])) active @endif">
                                <i class="{{ $item['icon'] }} nav-icon"></i>
                                <p>
                                    {{ $item['title'] }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($item['children'] as $child)
                                    <li class="nav-item">
                                        <a href="{{ route($child['route']) }}"
                                           class="nav-link @if(Route::currentRouteName() == $child['route']) active @endif">
                                            <i class="{{ $child['icon'] }} nav-icon"></i>
                                            <p>{{ $child['title'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach

                <!-- Profile - Available to all users -->
                {{-- <li class="nav-item @if(str_contains(Route::currentRouteName(), 'dashboard.profile')) active @endif">
                    <a href="#" class="nav-link @if(str_contains(Route::currentRouteName(), 'dashboard.profile')) active @endif">
                        <i class="fa-solid fa-user nav-icon"></i>
                        <p>Profile</p>
                    </a>
                </li> --}}

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

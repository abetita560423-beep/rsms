<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16"><path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354L7.207 1Z"/><path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Z"/></svg>
            </div>
            <span class="fs-4 fw-bolder text-dark tracking-tighter">RSMS</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Left Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('properties.listing') ? 'active' : '' }}" href="{{ route('properties.listing') }}">Explore</a>
                </li>

                @auth
                    @if(auth()->user()->isSeller())
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('properties.index') ? 'active' : '' }}" href="{{ route('properties.index') }}">My Properties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('seller.inquiries') ? 'active' : '' }}" href="{{ route('seller.inquiries') }}">Inquiries</a>
                        </li>
                    @elseif(auth()->user()->isAdmin() || auth()->user()->isStaff())
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('dashboard.admin', 'dashboard.staff') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('admin.properties.pending') ? 'active' : '' }}" href="{{ route('admin.properties.pending') }}">Pending</a>
                        </li>
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link px-3 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('dashboard', 'dashboard.buyer') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('buyer.inquiries') ? 'active' : '' }}" href="{{ route('buyer.inquiries') }}">Sent</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Right Side -->
            <div class="d-flex align-items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-dark fw-semibold px-0">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary shadow-sm">Get Started</a>
                @else
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary" style="width: 38px; height: 38px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="fw-semibold text-dark d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 rounded-4 p-2">
                            <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile.edit') }}">Profile Settings</a></li>
                            <li><hr class="dropdown-divider opacity-10"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-semibold">
                                        Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

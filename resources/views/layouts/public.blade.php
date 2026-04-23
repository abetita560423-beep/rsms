<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'RSMS'))</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0a4297;
            --primary-hover: #08367a;
            --bg-light: #f8f9fc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --card-radius: 1rem;
            --card-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        .btn-primary { 
            background-color: var(--primary-color); 
            border-color: var(--primary-color);
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .btn-primary:hover { 
            background-color: var(--primary-hover); 
            border-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1) !important;
        }

        .navbar {
            padding: 1.25rem 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .nav-link {
            font-weight: 600;
            color: var(--text-muted);
            transition: color 0.2s ease;
            padding: 0.5rem 1.25rem !important;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .badge {
            padding: 0.5em 0.8em;
            border-radius: 0.5rem;
            font-weight: 600;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="sticky-top bg-white border-bottom shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                    <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16"><path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354L7.207 1Z"/><path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Z"/></svg>
                    </div>
                    <span class="fs-4 fw-bolder text-dark tracking-tighter">SummitHub</span>
                </a>
                
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="publicNavbar">
                    <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('properties.listing', 'property.details') ? 'active' : '' }}" href="{{ route('properties.listing') }}">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <div class="d-flex gap-3 align-items-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none">Log In</a>
                            <a href="{{ route('register') }}" class="btn btn-primary rounded-pill shadow-sm">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @if (session('status'))
        <div class="container mt-4">
            <div class="alert alert-success border-0 shadow-sm rounded-4 px-4 py-3" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                    <span class="fw-semibold">{{ session('status') }}</span>
                </div>
            </div>
        </div>
    @endif

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

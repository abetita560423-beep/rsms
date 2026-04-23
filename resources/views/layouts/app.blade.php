<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RSMS') }} Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0a4297;
            --sidebar-width: 280px;
            --bg-light: #f8f9fc;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
        }
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid #eef2f7;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding-bottom: 3rem;
        }
        .nav-link-custom {
            padding: 0.8rem 1.5rem;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-radius: 12px;
            margin: 4px 16px;
            transition: all 0.2s;
        }
        .nav-link-custom:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }
        .nav-link-custom.active {
            background: rgba(10, 66, 151, 0.08);
            color: var(--primary-color);
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .notification-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 0;
            border: 2px solid white;
        }
        @media (max-width: 992px) {
            .sidebar { left: -100%; }
            .sidebar.show { left: 0; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column" id="sidebar">
        <div class="p-4 mb-4">
            <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
                <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16"><path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354L7.207 1Z"/><path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Z"/></svg>
                </div>
                <span class="fs-5 fw-bolder text-dark tracking-tighter">SummitHub</span>
            </a>
        </div>

        <div class="flex-grow-1">
            <!-- Common -->
            <a href="{{ route('dashboard') }}" class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M1 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V4zM1 9a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V9z"/></svg>
                Dashboard
            </a>

            <!-- ADMIN Only -->
            @if(auth()->user()->isAdmin())
                <div class="small fw-bold text-muted px-4 mt-4 mb-2 text-uppercase opacity-50" style="letter-spacing: 1px;">Administration</div>
                <a href="{{ route('admin.users.index') }}" class="nav-link-custom {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/></svg>
                    Manage Users
                </a>
                <a href="{{ route('admin.properties.index') }}" class="nav-link-custom {{ request()->routeIs('admin.properties.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16"><path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z"/><path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Z"/></svg>
                    Manage Properties
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="nav-link-custom {{ request()->routeIs('admin.transactions.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16"><path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27ZM1 2v12h12V2H1Zm1-1h10v1H2V1Z"/></svg>
                    Transactions
                </a>
                <a href="{{ route('admin.properties.pending') }}" class="nav-link-custom {{ request()->routeIs('admin.properties.pending') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M8 .5c-.647 0-1.507.49-2.73 1.054-1.215.558-2.447 1.106-3.426 1.485A1.502 1.502 0 0 0 1 4.432v7.469a1.502 1.502 0 0 0 .844 1.345c.979.379 2.211.927 3.426 1.485C6.493 15.29 7.353 15.78 8 15.78s1.507-.49 2.73-1.054c1.215-.558 2.447-1.106 3.426-1.485A1.502 1.502 0 0 0 15 11.9v-7.47a1.502 1.502 0 0 0-.844-1.344c-.979-.38-2.211-.928-3.426-1.485C9.507.99 8.647.5 8 .5zm.5 4.933a.5.5 0 0 1 .146.354v2.5a.5.5 0 0 1-.5.5h-2.5a.5.5 0 0 1-.354-.854l2.5-2.5a.5.5 0 0 1 .708 0z"/></svg>
                    Approvals
                </a>
            @endif

            <!-- STAFF Only -->
            @if(auth()->user()->isStaff())
                <div class="small fw-bold text-muted px-4 mt-4 mb-2 text-uppercase opacity-50" style="letter-spacing: 1px;">Management</div>
                <a href="{{ route('admin.properties.pending') }}" class="nav-link-custom {{ request()->routeIs('admin.properties.pending') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M8 .5c-.647 0-1.507.49-2.73 1.054-1.215.558-2.447 1.106-3.426 1.485A1.502 1.502 0 0 0 1 4.432v7.469a1.502 1.502 0 0 0 .844 1.345c.979.379 2.211.927 3.426 1.485C6.493 15.29 7.353 15.78 8 15.78s1.507-.49 2.73-1.054c1.215-.558 2.447-1.106 3.426-1.485A1.502 1.502 0 0 0 15 11.9v-7.47a1.502 1.502 0 0 0-.844-1.344c-.979-.38-2.211-.928-3.426-1.485C9.507.99 8.647.5 8 .5zm.5 4.933a.5.5 0 0 1 .146.354v2.5a.5.5 0 0 1-.5.5h-2.5a.5.5 0 0 1-.354-.854l2.5-2.5a.5.5 0 0 1 .708 0z"/></svg>
                    Approvals
                </a>
            @endif

            <!-- SELLER Only -->
            @if(auth()->user()->isSeller())
                <div class="small fw-bold text-muted px-4 mt-4 mb-2 text-uppercase opacity-50" style="letter-spacing: 1px;">Selling</div>
                <a href="{{ route('properties.index') }}" class="nav-link-custom {{ request()->routeIs('properties.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1zm11 0H3v14h3v-4h4v4h3V1Z"/></svg>
                    My Properties
                </a>
                <a href="{{ route('properties.create') }}" class="nav-link-custom {{ request()->routeIs('properties.create') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
                    Add Property
                </a>
                <a href="{{ route('seller.inquiries') }}" class="nav-link-custom {{ request()->routeIs('seller.inquiries') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/></svg>
                    My Inquiries
                </a>
                <a href="{{ route('seller.transactions') }}" class="nav-link-custom {{ request()->routeIs('seller.transactions') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16"><path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H2a1 1 0 0 0-1 1v1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/></svg>
                    My Sales
                </a>
            @endif

            <!-- BUYER Only -->
            @if(auth()->user()->isBuyer())
                <div class="small fw-bold text-muted px-4 mt-4 mb-2 text-uppercase opacity-50" style="letter-spacing: 1px;">Buying</div>
                <a href="{{ route('properties.listing') }}" class="nav-link-custom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
                    Browse Estates
                </a>
                <a href="{{ route('buyer.inquiries') }}" class="nav-link-custom {{ request()->routeIs('buyer.inquiries') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.001.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/></svg>
                    Sent Inquiries
                </a>
                <a href="{{ route('buyer.transactions') }}" class="nav-link-custom {{ request()->routeIs('buyer.transactions') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/></svg>
                    My Purchases
                </a>
            @endif

            <div class="small fw-bold text-muted px-4 mt-4 mb-2 text-uppercase opacity-50" style="letter-spacing: 1px;">Preferences</div>
            <a href="{{ route('profile.edit') }}" class="nav-link-custom {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/><path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.185 1.185l-.16.291a1.873 1.873 0 0 0 1.115 2.693l.319.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.185l-.291-.16a1.873 1.873 0 0 0-2.693 1.115l-.094.319c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.693-1.115l-.291.16c-.764.415-1.6-.42-1.185-1.185l.16-.291a1.873 1.873 0 0 0-1.115-2.693l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094a1.873 1.873 0 0 0 1.115-2.693l-.16-.291c-.415-.764.42-1.6 1.185-1.185l.291.16a1.873 1.873 0 0 0 2.693-1.115l.094-.319z"/></svg>
                Settings
            </a>
        </div>

        <div class="p-4 border-top">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary" style="width: 42px; height: 42px;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <div class="fw-bold text-dark text-truncate">{{ Auth::user()->name }}</div>
                    <div class="small text-muted text-uppercase fw-bold" style="font-size: 10px;">{{ Auth::user()->role }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-3 fw-bold">Sign Out</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="bg-white border-bottom sticky-top" style="z-index: 999;">
            <div class="container-fluid py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="h5 fw-bold text-dark mb-0">
                    @isset($header) {{ $header }} @endisset
                </div>
                <div class="d-flex align-items-center gap-3">
                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="btn btn-light rounded-circle p-2 position-relative shadow-none" type="button" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.491-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.228 14c.11 0 .21-.027.31-.081a1.296 1.296 0 0 0 .422-1.788c-.64-.943-1.03-2.46-1.03-3.131 0-.627.118-2.311.453-3.882a1.291 1.291 0 0 0-2.456-1.037l-.142.459L11.5 6c0 .667.15 2.583.479 4.145.17.809.391 1.645.69 2.355h-9.338c.299-.71.52-1.546.69-2.355C4.35 8.583 4.5 6.667 4.5 6l-.281-.459-.142-.459a1.291 1.291 0 0 0-2.456 1.037c.335 1.571.453 3.255.453 3.882 0 .671-.39 2.188-1.03 3.131a1.296 1.296 0 0 0 .422 1.788c.1.054.2.081.31.081h12.352z"/></svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="notification-dot"></span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 p-0 mt-2" style="width: 320px;">
                            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0">Notifications</h6>
                                <span class="badge bg-primary rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </div>
                            <div class="overflow-auto" style="max-height: 300px;">
                                @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                                    <div class="p-3 border-bottom {{ $notification->read_at ? 'opacity-75' : 'bg-light bg-opacity-50' }}">
                                        <div class="small fw-bold text-dark mb-1">{{ $notification->message }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                @empty
                                    <div class="p-4 text-center text-muted small">No notifications found.</div>
                                @endforelse
                            </div>
                            <div class="p-2 text-center">
                                <a href="#" class="small text-decoration-none fw-bold text-primary">View All</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-light fw-bold text-muted rounded-pill px-3">View Site</a>
                </div>
            </div>
        </header>

        <div class="container-fluid p-4">
            {{ $slot }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

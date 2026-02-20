<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-glass sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('movies.index') }}">
                <i class="bi bi-camera-reels-fill brand-icon"></i> <span class="brand-text">MovieHub</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->routeIs('movies.*') ? 'active' : '' }}" href="{{ route('movies.index') }}">
                            <i class="bi bi-film"></i> {{ __('messages.movies') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->routeIs('favorites.*') ? 'active' : '' }}" href="{{ route('favorites.index') }}">
                            <i class="bi bi-heart-fill"></i> {{ __('messages.favorites') }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-modern dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe"></i> {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-modern">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}"><i class="bi bi-check-circle-fill text-success me-2"></i>English</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'id') }}"><i class="bi bi-check-circle-fill text-success me-2"></i>Indonesia</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-logout">
                                <i class="bi bi-box-arrow-right"></i> {{ __('messages.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <main class="py-4">
        @if(session('success'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>

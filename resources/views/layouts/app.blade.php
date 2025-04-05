<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CyberVault</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>

    @yield('styles')
</head>
<body>

    {{-- 🧠 Only show this header if NOT on the home page --}}
    @unless (Request::is('home') || Request::is('/') || Request::is('home/search'))
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/home') }}">
                <i class="fas fa-shield-alt text-primary"></i> CyberVault
            </a>

            <!-- Right Buttons -->
            <div class="d-flex align-items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm d-flex align-items-center">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                @else
                    <span class="text-muted d-flex align-items-center">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </span>

                    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center position-relative">
                        <i class="fas fa-shopping-cart me-1"></i> Cart
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
    @endunless

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>

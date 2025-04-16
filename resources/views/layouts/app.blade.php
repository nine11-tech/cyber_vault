<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CyberVault</title>
    <meta name="description"
        content="Premium digital products at competitive prices - Software keys, gaming accounts, and more">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --cyber-primary: #39ff14;
            --cyber-secondary: #0d6efd;
            --cyber-dark: #121212;
            --cyber-light: #f8f9fa;
        }

        body {
            background-color: var(--cyber-dark);
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .cyber-text {
            color: var(--cyber-primary);
            text-shadow: 0 0 8px rgba(57, 255, 20, 0.5);
        }

        .cyber-bg {
            background-color: var(--cyber-dark);
            border: 1px solid rgba(57, 255, 20, 0.2);
        }

        .cyber-btn {
            border: 1px solid var(--cyber-primary);
            color: var(--cyber-primary);
            transition: all 0.3s ease;
        }

        .cyber-btn:hover {
            background-color: var(--cyber-primary);
            color: var(--cyber-dark);
            box-shadow: 0 0 15px rgba(57, 255, 20, 0.5);
        }

        .glow-effect {
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px rgba(57, 255, 20, 0.5);
            }

            to {
                text-shadow: 0 0 15px rgba(57, 255, 20, 0.8), 0 0 20px rgba(57, 255, 20, 0.4);
            }
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .nav-shadow {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cyber-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--cyber-primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2de20d;
        }
    </style>

    @yield('styles')
</head>

<body class="cyber-bg">

    {{-- 🧠 Only show this header if NOT on the home page --}}
    @unless (Request::is('home') || Request::is('/') || Request::is('home/search'))
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav-shadow sticky-top">
            <div class="container d-flex justify-content-between align-items-center">

                <!-- Logo -->
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2 cyber-text" href="{{ url('/home') }}">
                    <i class="fas fa-shield-alt me-1"></i> CyberVault
                </a>

                <!-- Right Buttons -->
                <div class="d-flex align-items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-primary btn-sm d-flex align-items-center cyber-btn">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="btn btn-outline-success btn-sm d-flex align-items-center cyber-btn">
                            <i class="fas fa-user-plus me-1"></i> Register
                        </a>
                    @else
                        <span class="text-white d-flex align-items-center">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </span>

                        <a href="{{ route('cart.index') }}"
                            class="btn btn-outline-light btn-sm d-flex align-items-center position-relative cyber-btn">
                            <i class="fas fa-shopping-cart me-1"></i> Cart
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger pulse">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center cyber-btn">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    @endunless

    <main class="@if(Request::is('home') || Request::is('/')) p-0 @else py-4 @endif">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5 border-top border-secondary">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="cyber-text">CyberVault</h5>
                    <p>Premium digital products at competitive prices.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-discord"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="cyber-text">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/home') }}" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">Products</a></li>
                        <li><a href="#" class="text-white">FAQ</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="cyber-text">Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Terms of Service</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-white">Refund Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="cyber-text">Newsletter</h5>
                    <p>Subscribe for exclusive deals</p>
                    <form class="mb-2">
                        <div class="input-group">
                            <input type="email" class="form-control bg-dark text-white border-secondary"
                                placeholder="Your email">
                            <button class="btn btn-outline-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 CyberVault. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>
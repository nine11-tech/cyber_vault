@extends('layouts.app')
@section('content')
    <!-- Custom Sticky Header -->
    <header class="bg-dark border-bottom border-secondary sticky-top shadow-sm py-2 px-3" style="z-index: 1055;">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
            {{-- Branding --}}
            <a class="navbar-brand fw-bold text-white me-4" href="{{ url('/home') }}" data-aos="fade-right">
                <i class="fas fa-shield-alt me-2 cyber-text"></i>CyberVault
            </a>

            {{-- Search bar --}}
            <form id="searchForm" action="{{ route('user.products.search') }}" method="GET"
                class="d-flex align-items-center flex-grow-1 me-3" style="max-width: 600px;" data-aos="fade-down">
                <div class="input-group">
                    <input type="text" name="query" class="form-control bg-dark text-white border-secondary" 
                           placeholder="Search for a product..." required>
                    <button type="submit" class="btn btn-outline-primary cyber-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            {{-- Right side: Cart + Auth --}}
            <div class="d-flex align-items-center gap-3" data-aos="fade-left">
                @auth
                    <span class="text-white d-flex align-items-center">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </span>
                @endauth
                <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm position-relative cyber-btn" id="cartButton">
                    <i class="fas fa-shopping-cart me-1"></i> CART
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger pulse"
                      id="cartCountBadge" style="font-size: 0.65rem;">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center cyber-btn">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm cyber-btn">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm cyber-btn">
                        <i class="fas fa-user-plus me-1"></i>Register
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Banner -->
    <section class="hero-section" style="height: 100vh; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/banner.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center" data-aos="zoom-in">
                    <h1 class="display-3 fw-bold cyber-text glow-effect mb-4" style="font-family: 'Courier New', monospace;">
                        ACCESS GRANTED
                    </h1>
                    <p class="lead text-white mb-5" style="font-family: 'Courier New', monospace; font-size: 1.5rem;">
                        Cyber Deals Unlocked — Decrypt and Deploy
                    </p>
                    <a href="#products" class="btn btn-lg cyber-btn pulse animate__animated animate__infinite animate__slower" 
                       style="padding: 12px 30px; font-size: 1.2rem;">
                        ENTER THE VAULT <i class="fas fa-arrow-down ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <h2 class="cyber-text">Why Choose CyberVault?</h2>
                    <p class="text-cyber-light">Premium digital products with guaranteed delivery</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 cyber-bg hover-scale p-4 text-center">
                        <div class="card-body">
                            <div class="icon-box mb-4">
                                <i class="fas fa-bolt cyber-text" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="cyber-text">Instant Delivery</h4>
                            <p class="text-white">Receive your product immediately after purchase via email</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 cyber-bg hover-scale p-4 text-center">
                        <div class="card-body">
                            <div class="icon-box mb-4">
                                <i class="fas fa-shield-alt cyber-text" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="cyber-text">Verified Products</h4>
                            <p class="text-white">All products tested and verified before listing</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 cyber-bg hover-scale p-4 text-center">
                        <div class="card-body">
                            <div class="icon-box mb-4">
                                <i class="fas fa-headset cyber-text" style="font-size: 2.5rem;"></i>
                            </div>
                            <h4 class="cyber-text">24/7 Support</h4>
                            <p class="text-white">Our team is always available to assist you</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Product Grid -->
<section class="py-5" id="products">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="cyber-text text-center">Featured Products</h2>
                <p class="text-cyber-light text-center">Browse our premium selection</p>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="alert alert-dark text-center fs-5 cyber-bg" data-aos="fade-up">
                <i class="fas fa-search me-2 text-cyber-lighter"></i> 
                <span class="text-cyber-lighter">No products found matching your search.</span>
            </div>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 hover-scale cyber-bg">
                            <a href="{{ route('products.user', $product->id) }}" class="position-relative">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}"
                                         class="card-img-top rounded-top-4"
                                         alt="{{ $product->name }}"
                                         style="height: 220px; object-fit: cover;">
                                @else
                                    <div class="bg-dark text-center py-5 rounded-top-4">
                                        <i class="fas fa-image fa-3x text-cyber-lighter"></i>
                                        <p class="text-cyber-lighter mt-2">No image</p>
                                    </div>
                                @endif
                                @if($product->stock <= 5 && $product->stock > 0)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark pulse">
                                        <i class="fas fa-bolt me-1"></i> Only {{ $product->stock }} left!
                                    </span>
                                @endif
                            </a>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="mb-3">
                                    <h5 class="card-title fw-bold text-white">{{ $product->name }}</h5>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="cyber-text fw-semibold">${{ number_format($product->price, 2) }}</span>
                                        
                                    </div>
                                    <div class="product-description">
                                        <p class="text-cyber-lighter small mb-2">{{ Str::limit($product->description, 80) }}</p>
                                    </div>
                                </div>

                                {{-- Add to Cart or Out of Stock --}}
                                @if($product->stock > 0)
                                    <div class="input-group mt-auto">
                                        <input type="number" class="form-control bg-darker text-white border-secondary quantity-input" 
                                               value="1" min="1" max="{{ $product->stock }}" data-id="{{ $product->id }}">
                                        <button class="btn btn-success add-to-cart cyber-btn" data-id="{{ $product->id }}">
                                            <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                        </button>
                                    </div>
                                @else
                                    <div class="alert alert-dark py-1 px-2 mb-0 small w-100 text-center rounded border border-warning">
                                        <i class="fas fa-times-circle me-1 text-warning"></i> 
                                        <span class="text-cyber-lighter">Out of Stock</span>
                                    </div>
                                @endif
                                <div class="cart-feedback mt-2" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h2 class="cyber-text">Customer Reviews</h2>
                    <p class="text-cyber-light">What our customers say about us</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 cyber-bg hover-scale p-4">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="50" height="50" alt="Customer">
                                <div>
                                    <h5 class="mb-0 text-white">John D.</h5>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white">"Got my Windows key instantly after payment. Working perfectly. Will definitely buy again!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 cyber-bg hover-scale p-4">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" height="50" alt="Customer">
                                <div>
                                    <h5 class="mb-0 text-white">Sarah K.</h5>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white">"Great prices and customer support helped me when I had an issue. Highly recommended!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 cyber-bg hover-scale p-4">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" class="rounded-circle me-3" width="50" height="50" alt="Customer">
                                <div>
                                    <h5 class="mb-0 text-white">Mike T.</h5>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white">"Been buying game keys here for months. Never had a single problem. Fast delivery every time."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="cyber-text mb-4">Join Our Newsletter</h2>
                    <p class="text-white mb-5">Subscribe to get exclusive deals and updates on new products</p>
                    <form class="row g-3 justify-content-center">
                        <div class="col-md-8">
                            <input type="email" class="form-control bg-dark text-white border-secondary" placeholder="Your email address">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn cyber-btn w-100">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
    $(document).ready(function () {
        // Add to cart functionality
        $('.add-to-cart').click(function () {
            const productId = $(this).data('id');
            const quantity = $(this).closest('.input-group').find('.quantity-input').val();
            const token = '{{ csrf_token() }}';
            const card = $(this).closest('.card');

            $.ajax({
                url: '/cart/add/' + productId,
                method: 'POST',
                data: {
                    _token: token,
                    quantity: quantity
                },
                success: function () {
                    const feedback = card.find('.cart-feedback');
                    feedback.html(`
                        <div class="alert alert-success alert-dismissible fade show py-1 px-2 mb-0" role="alert">
                            <i class="fas fa-check-circle me-1"></i> Product added to cart!
                        </div>
                    `);
                    feedback.fadeIn();

                    setTimeout(() => {
                        feedback.fadeOut();
                    }, 3000);

                    // Update cart badge with animation
                    const badge = document.getElementById('cartCountBadge');
                    if (badge) {
                        let currentCount = parseInt(badge.textContent);
                        const addedQty = parseInt(quantity) || 1;
                        badge.textContent = currentCount + addedQty;

                        // Add pulse animation
                        badge.classList.add('animate__animated', 'animate__pulse');
                        setTimeout(() => {
                            badge.classList.remove('animate__animated', 'animate__pulse');
                        }, 1000);
                    }
                },
                error: function () {
                    const feedback = card.find('.cart-feedback');
                    feedback.html(`<div class="alert alert-danger py-1 px-2 mb-0">❌ Failed, might be max quantity.</div>`);
                    feedback.fadeIn();

                    setTimeout(() => {
                        feedback.fadeOut();
                    }, 3000);
                }
            });
        });

        // Auto-scroll to products section if search was performed
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('query')) {
            const productsSection = document.getElementById('products');
            if (productsSection) {
                setTimeout(() => {
                    productsSection.scrollIntoView({ behavior: 'smooth' });
                }, 500);
            }
        }

        // Add hover effect to cards
        $('.card').hover(
            function() {
                $(this).find('.card-title').addClass('text-primary');
            },
            function() {
                $(this).find('.card-title').removeClass('text-primary');
            }
        );
    });

    // Initialize tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    </script>

    <style>
            :root {
            --cyber-darker: #0a0a0a; /* Slightly darker than cyber-dark */
        }
        
        .bg-darker {
            background-color: var(--cyber-darker) !important;
        }
        
        .text-cyber-lighter {
            color: #e0e0e0 !important; /* Brighter light gray */
        }
        
        .product-description {
            border-left: 2px solid rgba(57, 255, 20, 0.3);
            padding-left: 12px;
            margin: 10px 0;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(57, 255, 20, 0.1);
        }
        
        .quantity-input:focus {
            border-color: var(--cyber-primary);
            box-shadow: 0 0 0 0.25rem rgba(57, 255, 20, 0.25);
        }
        .card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-img-top {
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input {
            -moz-appearance: textfield;
            text-align: center;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(57, 255, 20, 0.1);
            border-radius: 50%;
        }

        .testimonial-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
@endsection
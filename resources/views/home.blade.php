@extends('layouts.app')
<!-- Custom Sticky Header -->
<div class="bg-white border-bottom sticky-top shadow-sm py-2 px-3" style="z-index: 1055;">
    <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        {{-- Branding --}}
        <a class="navbar-brand fw-bold text-dark me-4" href="{{ url('/home') }}">
            <i class="fas fa-shield-alt me-2 text-primary"></i>CyberVault
        </a>

        {{-- Search bar --}}
        <form id="searchForm" action="{{ route('user.products.search') }}" method="GET"
            class="d-flex align-items-center flex-grow-1 me-3" style="max-width: 600px; margin-bottom: -2px;">
            <input type="text" name="query" class="form-control me-2" placeholder="Search for a product..." required>
            <button type="submit" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-search"></i>
            </button>
        </form>


        {{-- Right side: Cart + Auth --}}
        <div class="d-flex align-items-center gap-2">
            @auth
                <span class="text-muted d-flex align-items-center">
                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                </span>
            @endauth
            <a href="{{ route('cart.index') }}" class="btn btn-outline-dark btn-sm position-relative" id="cartButton">
                <i class="fas fa-shopping-cart me-1"></i>BUY
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                  id="cartCountBadge" style="font-size: 0.65rem;">
                {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-sign-in-alt me-1"></i>Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-user-plus me-1"></i>Register
                </a>
            @endauth
        </div>
    </div>
</div>

@section('content')
<!-- Hero Banner -->
<div class="container-fluid p-0 m-0 text-center text-neon-green"style="height: 100vh; background-image: url('{{ asset('images/banner.jpg') }}'); background-size: cover; display: flex; align-items: center; justify-content: center; background-position: center;"
>
    <div style="background-color: rgba(0, 0, 0, 0.7); padding: 40px; border-radius: 20px;">
        <h1 class="display-4 fw-bold" style="color: #39ff14; font-family: 'Courier New', monospace; text-shadow: 0 0 10px #39ff14;">
            ACCESS GRANTED
        </h1>
        <p class="lead" style="color: #ccc; font-family: 'Courier New', monospace;">
            Cyber Deals Unlocked — Decrypt and Deploy
        </p>
        <a href="#products" class="btn btn-warning btn-lg mt-3">ENTER THE VAULT</a>
    </div>
</div>

<!-- Product Grid -->
<div class="container py-5" id="products">
    @if($products->isEmpty())
        <div class="alert alert-info text-center fs-5">
            No products found matching your search.
        </div>
    @else
        <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-shadow transition-all">
                    <a href="{{ route('products.user', $product->id) }}">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}"
                                 class="card-img-top rounded-top-4"
                                 alt="{{ $product->name }}"
                                 style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5 rounded-top-4">
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <p>No image</p>
                            </div>
                        @endif
                    </a>

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="mb-3">
                            <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                            <p class="text-primary fw-semibold mb-0">${{ number_format($product->price, 2) }}</p>
                        </div>

                        {{-- Add to Cart or Out of Stock --}}
                        @if($product->stock > 0)
                            <div class="input-group">
                                <input type="number" class="form-control quantity-input" value="1" min="1" max="{{ $product->stock }}" data-id="{{ $product->id }}">
                                <button class="btn btn-success add-to-cart" data-id="{{ $product->id }}">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        @else
                            <div class="alert alert-warning py-1 px-2 mb-0 small w-100 text-center rounded">
                                <i class="fas fa-exclamation-circle me-1"></i> Out of Stock
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

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
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
            // Update cart badge
            const badge = document.getElementById('cartCountBadge');
            if (badge) {
                let currentCount = parseInt(badge.textContent);
                const addedQty = parseInt(quantity) || 1;
                badge.textContent = currentCount + addedQty;
            }
        },
        error: function () {
            const feedback = card.find('.cart-feedback');
            feedback.html(`<div class="alert alert-danger py-1 px-2 mb-0">❌ Failed,might be max quantity.</div>`);
            feedback.fadeIn();

            setTimeout(() => {
                feedback.fadeOut();
            }, 3000);
            }
        });
    });
});
</script>
<script>
    // Auto-scroll to products section if search was performed
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('query')) {
            const productsSection = document.getElementById('products');
            if (productsSection) {
                productsSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
</script>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
</script>
<style>
    .hover-shadow {
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.1rem;
    }

    .card .input-group {
        margin-top: auto;
    }

    .card .btn-success {
        font-size: 0.9rem;
    }

    .card .quantity-input {
        max-width: 70px;
    }
</style>

@endsection


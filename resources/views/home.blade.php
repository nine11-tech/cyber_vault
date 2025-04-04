@extends('layouts.app')

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

<!-- Search + Cart Fixed Bar -->
<div class="bg-light shadow sticky-top py-2 px-3 d-flex justify-content-between align-items-center" style="z-index: 1050;">
<form action="{{ route('user.products.search') }}" method="GET" class="d-flex w-75 me-2" id="searchForm">
        <input type="text" name="query" class="form-control me-2" placeholder="Search for a product...">
        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
    </form>
    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark position-relative">
        <i class="fas fa-shopping-cart fa-lg"></i>
        <div class="small">Cart</div>
    </a>
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
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('products.user', $product->id) }}">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light text-center py-5">
                                    <i class="fas fa-image fa-2x text-muted"></i>
                                    <p>No image</p>
                                </div>
                            @endif
                        </a>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-primary fw-bold mb-3">${{ number_format($product->price, 2) }}</p>
                            <div class="input-group">
                                <input type="number" class="form-control quantity-input" value="1" min="1" data-id="{{ $product->id }}">
                                <button class="btn btn-success add-to-cart" data-id="{{ $product->id }}">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
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
            feedback.html(`<div class="alert alert-success py-1 px-2 mb-0">✔ Product added to cart!</div>`);
            feedback.fadeIn();

            setTimeout(() => {
                feedback.fadeOut();
            }, 2500);
        },
        error: function () {
            const feedback = card.find('.cart-feedback');
            feedback.html(`<div class="alert alert-danger py-1 px-2 mb-0">❌ Failed to add product.</div>`);
            feedback.fadeIn();

            setTimeout(() => {
                feedback.fadeOut();
            }, 2500);
            }
        });
    });
});
$('#searchForm').submit(function (e) {
    const base = $(this).attr('action');
    const query = $(this).find('input[name="query"]').val();
    const fullUrl = base + '?query=' + encodeURIComponent(query) + '#products';
    $(this).attr('action', fullUrl);
});

</script>
@endsection


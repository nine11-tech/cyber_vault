@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        {{-- Product Image --}}
        <div class="col-md-6">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded-4 shadow-sm border"
                     style="max-height: 450px; object-fit: contain;">
            @else
                <div class="bg-light text-center py-5 rounded-3">
                    <i class="fas fa-image fa-3x text-muted"></i>
                    <p class="mt-2">No image available</p>
                </div>
            @endif
        </div>

        {{-- Product Details --}}
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <h4 class="text-success mb-3">${{ number_format($product->price, 2) }}</h4>

            <ul class="list-unstyled mb-4">
                <li><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</li>
                <li><strong>In stock:</strong> 
                    @if($product->stock > 0)
                        {{ $product->stock }}
                    @else
                        <span class="text-danger">Out of stock</span>
                    @endif
                </li>
            </ul>

            <div class="mb-4">
                <h5 class="fw-semibold">Description</h5>
                <p class="text-muted">{{ $product->description ?? 'No description available.' }}</p>
            </div>

            {{-- Cart Form or Message --}}
            @php
                $alreadyInCart = $currentInCart ?? 0;
                $remainingStock = $product->stock - $alreadyInCart;
            @endphp

            @if($product->stock > 0)
                @if($remainingStock <= 0)
                    <div class="alert alert-warning d-inline-block">
                        <i class="fas fa-check-circle me-1"></i> 
                        You already have the maximum quantity of this product in your cart.
                    </div>
                @else
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" max="{{ $remainingStock }}"
                               class="form-control" style="max-width: 100px;">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-cart-plus me-1"></i> Add to Cart
                        </button>
                    </form>
                @endif
            @else
                <div class="alert alert-warning d-inline-block">
                    <i class="fas fa-exclamation-triangle me-1"></i> This product is currently out of stock.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

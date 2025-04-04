@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-md-6">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" 
                     class="img-fluid rounded shadow" style="max-height: 400px; object-fit: contain;">
            @else
                <div class="bg-light text-center py-5 rounded">
                    <i class="fas fa-image fa-3x text-muted"></i>
                    <p class="mt-2 mb-0">No image</p>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <h4 class="text-primary">${{ number_format($product->price, 2) }}</h4>
            <p class="mb-2"><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</p>
            <p class="mb-2"><strong>In stock:</strong> {{ $product->stock }}</p>
            <div class="mt-4">
                <h5>Description</h5>
                <p>{{ $product->description ?? 'No description available' }}</p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-cart-plus me-1"></i> Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

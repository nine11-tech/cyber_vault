@php
    if (!Auth::check() || !Auth::user()->is_admin) {
        abort(403, 'Unauthorized access');
    }
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $product->name }}</h2>
                    <a href="{{ route('products.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                class="img-fluid rounded-3 shadow mb-4"
                                style="max-height: 400px; width: 100%; object-fit: contain;">
                        @else
                            <div class="bg-light text-center py-5 rounded-3 mb-4">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="mt-2 mb-0">No image available</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4">
                            <h4 class="text-muted">Product Details</h4>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Price:</div>
                                <div class="col-8">${{ number_format($product->price, 2) }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Category:</div>
                                <div class="col-8">{{ $product->category ?? 'N/A' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Stock:</div>
                                <div class="col-8">{{ $product->stock ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-muted">Description</h4>
                            <hr>
                            <p class="lead">{{ $product->description ?? 'No description available' }}</p>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning flex-grow-1">
                                <i class="fas fa-edit me-2"></i>Edit Product
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
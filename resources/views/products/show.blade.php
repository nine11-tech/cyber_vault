@php
    if (!Auth::check() || !Auth::user()->is_admin) {
        abort(403, 'Unauthorized access');
    }
@endphp

@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom right, #0f0f0f, #1a1a1a);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e4e4e4;
        }

        .product-card {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: rgba(23, 25, 30, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(57, 255, 20, 0.3);
            backdrop-filter: blur(5px);
        }

        .product-header {
            border-bottom: 1px solid rgba(57, 255, 20, 0.3);
            padding-bottom: 15px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-title {
            font-weight: 600;
            color: #39ff14;
            margin-bottom: 0;
            text-shadow: 0 0 5px rgba(57, 255, 20, 0.3);
        }

        .btn-hacker {
            background-color: #39ff14;
            border: none;
            color: #0f0f0f;
            font-weight: 600;
            transition: 0.2s ease-in-out;
            box-shadow: 0 0 10px #39ff14;
        }

        .btn-hacker:hover {
            background-color: #2ee70b;
            box-shadow: 0 0 15px #39ff14, 0 0 10px #39ff14;
        }

        .btn-hacker-outline {
            background-color: transparent;
            border: 1px solid #39ff14;
            color: #39ff14;
            font-weight: 600;
            transition: 0.2s ease-in-out;
        }

        .btn-hacker-outline:hover {
            background-color: rgba(57, 255, 20, 0.1);
            box-shadow: 0 0 10px rgba(57, 255, 20, 0.3);
        }

        .detail-label {
            color: #39ff14;
            font-weight: 500;
        }

        .detail-value {
            color: #eaeaea;
        }

        .section-title {
            color: #39ff14;
            font-weight: 500;
            margin-top: 20px;
        }

        .divider {
            border-color: rgba(57, 255, 20, 0.3);
            margin: 15px 0;
        }

        .no-image {
            background-color: rgba(28, 31, 36, 0.8);
            color: #bbbbbb;
            text-align: center;
            padding: 40px 0;
            border-radius: 8px;
            border: 1px dashed #444;
        }

        .product-image {
            max-height: 400px;
            width: 100%;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #444;
            box-shadow: 0 0 15px rgba(57, 255, 20, 0.1);
        }

        .description-text {
            color: #eaeaea;
            line-height: 1.6;
        }
    </style>

    <div class="product-card">
        <div class="product-header">
            <h2 class="product-title">{{ $product->name }}</h2>
            <a href="{{ route('products.index') }}" class="btn btn-hacker-outline">
                <i class="fas fa-arrow-left me-2"></i>Back to Products
            </a>
        </div>

        <div class="product-body">
            <div class="row">
                <div class="col-md-6">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                            class="product-image">
                    @else
                        <div class="no-image rounded-3">
                            <i class="fas fa-image fa-3x"></i>
                            <p class="mt-2 mb-0">No image available</p>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <h4 class="section-title">Product Details</h4>
                    <hr class="divider">

                    <div class="row mb-3">
                        <div class="col-4 detail-label">Price:</div>
                        <div class="col-8 detail-value">${{ number_format($product->price, 2) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 detail-label">Category:</div>
                        <div class="col-8 detail-value">{{ $product->category ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 detail-label">Stock:</div>
                        <div class="col-8 detail-value">{{ $product->stock ?? 'N/A' }}</div>
                    </div>

                    <h4 class="section-title">Description</h4>
                    <hr class="divider">
                    <p class="description-text">{{ $product->description ?? 'No description available' }}</p>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-hacker flex-grow-1">
                            <i class="fas fa-edit me-2"></i>Edit Product
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-hacker-outline w-100">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
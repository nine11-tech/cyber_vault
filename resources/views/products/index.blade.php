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

        .management-card {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: rgba(23, 25, 30, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(57, 255, 20, 0.3);
            backdrop-filter: blur(5px);
        }

        .management-header {
            border-bottom: 1px solid rgba(57, 255, 20, 0.3);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .management-title {
            font-weight: 600;
            color: #39ff14;
            margin-bottom: 0;
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

        .table-dark {
            background-color: rgba(28, 31, 36, 0.8);
            color: #eaeaea;
        }

        .table-dark th {
            border-bottom: 2px solid #39ff14;
        }

        .table-dark td,
        .table-dark th {
            border-color: #444;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(57, 255, 20, 0.05);
        }

        .form-control {
            background-color: #1c1f24;
            border: 1px solid #444;
            color: #eaeaea;
        }

        .form-control:focus {
            border-color: #39ff14;
            box-shadow: 0 0 5px rgba(57, 255, 20, 0.6);
        }

        .alert {
            background-color: rgba(28, 31, 36, 0.9);
            border: 1px solid #444;
            color: #eaeaea;
        }

        .alert-success {
            border-color: #39ff14;
        }

        .alert-info {
            border-color: #17a2b8;
        }

        .product-link {
            color: #39ff14;
            text-decoration: none;
            transition: 0.2s;
        }

        .product-link:hover {
            color: #2ee70b;
            text-shadow: 0 0 5px rgba(57, 255, 20, 0.5);
        }
    </style>

    <div class="management-card">
        <div class="management-header d-flex justify-content-between align-items-center">
            <h2 class="management-title">Product Management</h2>
            <a href="{{ route('products.create') }}" class="btn btn-hacker">
                <i class="fas fa-plus me-2"></i>Add Product
            </a>
        </div>

        <div class="management-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('products.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search products..."
                        value="{{ request('query') }}">
                    <button type="submit" class="btn btn-hacker">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            @if($products->isEmpty())
                <div class="alert alert-info">
                    No products found matching your search.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}" class="product-link fw-bold">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->category ?? 'N/A' }}</td>
                                    <td>{{ $product->stock ?? 'N/A' }}</td>
                                    <td class="text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-sm btn-hacker-outline">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-hacker-outline">
                                                    <i class="fas fa-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
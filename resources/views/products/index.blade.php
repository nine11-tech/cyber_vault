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
                    <h2 class="mb-0">Product Management</h2>
                    <a href="{{ route('products.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Add Product
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
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
                        <button type="submit" class="btn btn-primary">
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
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-dark">
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
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="text-decoration-none text-dark fw-bold">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->category ?? 'N/A' }}</td>
                                        <td>{{ $product->stock ?? 'N/A' }}</td>
                                        <td class="text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
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
    </div>
@endsection
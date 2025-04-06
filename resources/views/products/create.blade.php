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
            <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Product</h2>
        </div>

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Product Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                        <input type="text" class="form-control" name="name" 
                            placeholder="Enter product name" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-align-left"></i></span>
                        <textarea class="form-control" name="description" 
                            placeholder="Product description" rows="4"></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-dollar-sign"></i></span>
                        <input type="number" class="form-control" name="price" 
                            step="0.01" placeholder="0.00" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="category" class="form-label">Category</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-list"></i></span>
                        <input type="text" class="form-control" name="category" 
                            placeholder="Product category">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="stock" class="form-label">Stock</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-boxes"></i></span>
                        <input type="number" class="form-control" name="stock" 
                            placeholder="Available quantity">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Product Image</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-image"></i></span>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <small class="text-muted">Allowed formats: jpg, png, jpeg. Max size: 2MB</small>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
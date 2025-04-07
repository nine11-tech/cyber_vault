@php
    if (!Auth::check() || !Auth::user()->is_admin) {
        abort(403, 'Unauthorized access');
    }
@endphp

@extends('layouts.app')

@section('content')
<style>
    .admin-form {
        background: rgba(23, 25, 30, 0.95);
        border-radius: 16px;
        padding: 40px;
        color: #e4e4e4;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.08);
    }

    .admin-form label {
        color: #39ff14;
        font-weight: 500;
    }

    .admin-form .form-control {
        background-color: #1c1f24;
        border: 1px solid #444;
        color: #eaeaea;
    }

    .admin-form .form-control:focus {
        border-color: #39ff14;
        box-shadow: 0 0 6px rgba(57, 255, 20, 0.5);
    }

    .admin-form .input-group-text {
        background-color: #2c2f36;
        color: #aaa;
        border-color: #444;
    }

    .admin-form small {
        color: #aaa;
    }

    .btn-save {
        background-color: #39ff14;
        color: #000;
        font-weight: bold;
        border: none;
        box-shadow: 0 0 10px #39ff14;
        transition: 0.2s;
    }

    .btn-save:hover {
        background-color: #2ecc71;
        box-shadow: 0 0 15px #2ecc71;
        color: #000;
    }

    .btn-cancel {
        background-color: #444;
        color: #eee;
        border: 1px solid #666;
        transition: 0.2s;
    }

    .btn-cancel:hover {
        background-color: #555;
        border-color: #999;
    }
</style>

<div class="container py-5">
    <div class="admin-form">
        <h2 class="mb-4 fw-bold text-center"><i class="fas fa-plus-circle me-2"></i>Add New Product</h2>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="form-label">Product Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    <input type="text" class="form-control" name="name" placeholder="Enter product name" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                    <textarea class="form-control" name="description" placeholder="Product description" rows="4"></textarea>
                </div>
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" class="form-control" name="price" step="0.01" placeholder="0.00" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="category" class="form-label">Category</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                    <input type="text" class="form-control" name="category" placeholder="Product category">
                </div>
            </div>

            <div class="mb-4">
                <label for="stock" class="form-label">Stock</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                    <input type="number" class="form-control" name="stock" placeholder="Available quantity">
                </div>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Product Image</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <small>Allowed formats: jpg, png, jpeg. Max size: 2MB</small>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-cancel">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i>Add Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Product</h2>
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

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Debug Section (Temporary - Remove after testing) -->
                    @if($product->image_path)
                        <div class="alert alert-info mb-4">
                            <h5 class="mb-2">Image Debug Information:</h5>
                            <p class="mb-1"><strong>Stored Path:</strong> {{ $product->image_path }}</p>
                            <p class="mb-1"><strong>Full URL:</strong> {{ asset('storage/' . $product->image_path) }}</p>
                            <p class="mb-1"><strong>File Exists:</strong>
                                {{ file_exists(storage_path('app/public/' . $product->image_path)) ? 'Yes' : 'No' }}
                            </p>
                        </div>
                    @endif

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label">Product Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}"
                                required>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control" name="description"
                                rows="4">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" class="form-control" name="price" step="0.01"
                                value="{{ old('price', $product->price) }}" required>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category" class="form-label">Category</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-list"></i></span>
                            <input type="text" class="form-control" name="category"
                                value="{{ old('category', $product->category) }}">
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="form-label">Stock</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-boxes"></i></span>
                            <input type="number" class="form-control" name="stock"
                                value="{{ old('stock', $product->stock) }}">
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="form-label">Product Image</label>

                        @if($product->image_path)
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Current Product Image"
                                    class="img-thumbnail mb-2" style="max-height: 200px; max-width: 100%;">
                                <p class="text-muted">Current Image</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                    <label class="form-check-label text-danger" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-image"></i></span>
                            <input type="file" class="form-control" name="image" accept="image/jpeg,image/png">
                        </div>
                        <small class="text-muted">
                            Max file size: 2MB | Allowed formats: JPEG, PNG
                            @if($product->image_path)
                                | Leave blank to keep current image
                            @endif
                        </small>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
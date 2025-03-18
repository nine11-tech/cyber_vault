@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

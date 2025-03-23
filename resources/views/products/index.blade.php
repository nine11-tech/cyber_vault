@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Products</h2>
        <form action="{{ route('products.search') }}" method="GET" class="mb-3">
    <input type="text" name="query" class="form-control" placeholder="Search for a product...">
    <button type="submit" class="btn btn-primary mt-2">Search</button>
</form>

        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        @if(count($products) == 0)
    <p>No products found matching your search.</p>
@endif

        <table class="table">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                <td>
    <form action="{{ route('carts.create', $product->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Add to Cart</button>
    </form>
</td>

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

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Products</h2>

        {{-- Search Form --}}
        <form action="{{ route('products.search') }}" method="GET" class="mb-3">
            <input type="text" name="query" class="form-control" placeholder="Search for a product...">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

        {{-- No Products Message --}}
        @if($products->isEmpty())
            <p>No products found matching your search.</p>
        @else
            {{-- Products Table --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td class="d-flex gap-2">
                                {{-- Add to Cart --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <input type="number" name="quantity" min="1" value="1" class="form-control" style="width: 80px;">
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                    </form>


                                {{-- Delete Product --}}
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Delete</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php
                        $total = $item['price'] * $item['quantity'];
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control me-2" style="width: 80px;">
                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                             @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                            </td>


                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>${{ number_format($total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: ${{ number_format($grandTotal, 2) }}</h4>

        <a href="{{ route('paypal.email') }}" class="btn btn-success">Proceed to Checkout</a>
    @endif
</div>
@endsection

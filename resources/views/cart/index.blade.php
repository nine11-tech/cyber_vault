@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold"><i class="fas fa-shopping-cart me-2"></i>Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info text-center fs-5">
            Your cart is empty. <a href="{{ route('home') }}" class="fw-bold">Continue shopping</a>
        </div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
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
                            <td class="fw-semibold">{{ $item['name'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ \App\Models\Product::find($id)->stock ?? 1 }}" class="form-control form-control-sm" style="width: 80px;">
                                    @if(session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-sync-alt"></i> Update
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </form>
                            </td>
                            <td class="text-success">${{ number_format($item['price'], 2) }}</td>
                            <td class="fw-bold">${{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Grand Total --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4 class="fw-bold">Total: <span class="text-success">${{ number_format($grandTotal, 2) }}</span></h4>

            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                </a>
                <a href="{{ route('paypal.email') }}" class="btn btn-success">
                    <i class="fas fa-credit-card me-1"></i> Proceed to Checkout
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 4000);
</script>
@endsection

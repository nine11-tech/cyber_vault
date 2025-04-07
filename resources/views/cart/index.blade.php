@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom right, #0f0f0f, #1a1a1a);
    }

    .cart-container {
        background: rgba(23, 25, 30, 0.95);
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.15);
        color: #e4e4e4;
    }

    .table-dark th {
        background-color: #101820 !important;
        color: #39ff14;
        border: none;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(57, 255, 20, 0.05);
    }

    .form-control-sm {
        background-color: #1c1f24;
        border: 1px solid #444;
        color: #eaeaea;
    }

    .form-control-sm:focus {
        border-color: #39ff14;
        box-shadow: 0 0 8px rgba(57, 255, 20, 0.4);
    }

    .btn-update {
        background-color: #ffc107;
        border: none;
        color: #1a1a1a;
        font-weight: bold;
    }

    .btn-update:hover {
        background-color: #e0a800;
        box-shadow: 0 0 10px #ffc107;
    }

    .btn-remove {
        background-color: #ff4e4e;
        border: none;
        color: #fff;
    }

    .btn-remove:hover {
        background-color: #d63333;
        box-shadow: 0 0 10px #ff4e4e;
    }

    .btn-neon-checkout {
        background-color: #39ff14;
        color: #000;
        font-weight: bold;
        border: none;
        box-shadow: 0 0 10px #39ff14;
    }

    .btn-neon-checkout:hover {
        background-color: #2ecc71;
        box-shadow: 0 0 15px #2ecc71;
    }

    .alert {
        border-radius: 8px;
    }
</style>

<div class="container py-5">
    <div class="cart-container">
        <h2 class="mb-4 fw-bold"><i class="fas fa-shopping-cart me-2"></i>Your Cart</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(empty($cart))
            <div class="alert alert-info text-center fs-5">
                Your cart is empty. <a href="{{ route('home') }}" class="fw-bold text-neon">Continue shopping</a>
            </div>
        @else
            <div class="table-responsive rounded overflow-hidden">
                <table class="table table-hover align-middle mb-0">
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
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex flex-wrap align-items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-0" style="flex: 1 1 auto; min-width: 60px;">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                max="{{ \App\Models\Product::find($id)->stock ?? 1 }}"
                                                class="form-control form-control-sm px-2 py-1 bg-dark text-light border border-secondary"
                                                style="min-width: 60px;">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-update px-3">
                                            <i class="fas fa-sync-alt me-1"></i> Update
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-remove">
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

            <div class="d-flex justify-content-between align-items-center mt-4">
                <h4 class="fw-bold">Total: <span class="text-success">${{ number_format($grandTotal, 2) }}</span></h4>

                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                    </a>
                    <a href="{{ route('paypal.email') }}" class="btn btn-neon-checkout">
                        <i class="fas fa-credit-card me-1"></i> Proceed to Checkout
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
    }, 4000);
</script>
@endsection

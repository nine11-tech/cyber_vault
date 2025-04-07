@extends('layouts.app')

@section('content')
<style>
    .checkout-card {
        max-width: 480px;
        margin: 60px auto;
        padding: 40px;
        background: rgba(23, 25, 30, 0.95);
        border-radius: 16px;
        text-align: center;
        color: #e4e4e4;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.1);
    }

    .checkout-card h2 {
        font-weight: 600;
        font-size: 26px;
        color: #39ff14;
        margin-bottom: 10px;
    }

    .checkout-card p {
        font-size: 1rem;
        color: #ccc;
    }

    .checkout-card img {
        width: 80px;
        margin-bottom: 20px;
    }

    .secure-msg {
        font-size: 0.9rem;
        margin-top: 25px;
        color: #a8a8a8;
    }

    .secure-msg i {
        color: #39ff14;
        margin-right: 6px;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="checkout-card">
        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="PayPal">

        <h2>Secure Checkout</h2>
        <p>Pay with PayPal or Credit Card</p>

        <div id="paypal-button-container" class="my-4"></div>

        <p class="secure-msg">
            <i class="fas fa-lock"></i>
            Your payment is protected with industry-standard encryption.
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AQX_MI2VlRE3WaLTIJi-rTlZsx73W2ofX6yCp1_GfJzRa7QXWUk1_J5AL-c9gcQP_K5jBJV9lYZkpq3t&currency=USD"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color: 'gold',
                shape: 'pill',
                label: 'paypal',
            },
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total ?? "10.00" }}'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function () {
                    window.location.href = "{{ route('paypal.success') }}";
                });
            },
            onCancel: function () {
                window.location.href = "{{ route('paypal.cancel') }}";
            }
        }).render('#paypal-button-container');
    });
</script>
@endpush

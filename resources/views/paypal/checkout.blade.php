@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="shadow-lg rounded-4 p-5 bg-white text-center" style="max-width: 480px; width: 100%;">
        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="PayPal" width="80" class="mb-3">
        <h2 class="fw-bold text-dark mb-2">Secure Checkout</h2>
        <p class="text-muted mb-4">Pay with PayPal or Credit Card</p>

        <div id="paypal-button-container" class="mb-4"></div>

        <p class="small text-muted">
            <i class="fas fa-lock me-1"></i>
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

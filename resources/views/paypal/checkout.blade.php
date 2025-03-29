@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="shadow-lg rounded-4 p-5 bg-white" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="PayPal" width="90">
            <h2 class="mt-3 fw-bold text-dark">Secure Checkout</h2>
            <p class="text-muted">Pay with PayPal or credit card</p>
        </div>

        <div id="paypal-button-container" class="mb-3"></div>

        <div class="text-center mt-4">
            <p class="small text-muted">🔒 Your payment is protected with industry-standard encryption.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- PayPal SDK --}}
    <script src="https://www.paypal.com/sdk/js?client-id=AQX_MI2VlRE3WaLTIJi-rTlZsx73W2ofX6yCp1_GfJzRa7QXWUk1_J5AL-c9gcQP_K5jBJV9lYZkpq3t&currency=USD"></script>

    {{-- PayPal Button --}}
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
                    return actions.order.capture().then(function (details) {
                        window.location.href = "{{ route('paypal.success') }}";
                    });
                },
                onCancel: function (data) {
                    window.location.href = "{{ route('paypal.cancel') }}";
                }
            }).render('#paypal-button-container');
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4">Pay with PayPal</h2>

    <div id="paypal-button-container"></div>
</div>
@endsection

@push('scripts')
    {{-- PayPal SDK --}}
    <script src="https://www.paypal.com/sdk/js?client-id=AQX_MI2VlRE3WaLTIJi-rTlZsx73W2ofX6yCp1_GfJzRa7QXWUk1_J5AL-c9gcQP_K5jBJV9lYZkpq3t&currency=USD"></script>

    {{-- PayPal Button --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '{{ $total ?? "10.00" }}' // fallback for safety
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
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

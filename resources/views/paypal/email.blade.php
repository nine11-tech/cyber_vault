@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-envelope me-2"></i>Confirm Your Email</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('paypal.capture.email') }}" method="POST" id="emailForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                            <span id="submitText"><i class="fas fa-paper-plane me-1"></i>Proceed to Checkout</span>
                            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('emailForm')?.addEventListener('submit', function () {
        document.getElementById('submitText').classList.add('d-none');
        document.getElementById('spinner').classList.remove('d-none');
        document.getElementById('submitBtn').disabled = true;
    });
</script>
@endsection

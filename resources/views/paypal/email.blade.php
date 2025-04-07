@extends('layouts.app')

@section('content')
<style>
    .email-card {
        max-width: 480px;
        margin: 80px auto;
        padding: 40px;
        background: rgba(23, 25, 30, 0.95);
        border-radius: 16px;
        color: #e4e4e4;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.1);
    }

    .email-card h4 {
        font-weight: 600;
        color: #39ff14;
        margin-bottom: 20px;
    }

    .form-control {
        background-color: #1c1f24;
        border: 1px solid #444;
        color: #eaeaea;
    }

    .form-control:focus {
        border-color: #39ff14;
        box-shadow: 0 0 5px rgba(57, 255, 20, 0.6);
    }

    .btn-hacker {
        background-color: #39ff14;
        border: none;
        color: #000;
        font-weight: 600;
        box-shadow: 0 0 10px #39ff14;
        transition: all 0.2s ease-in-out;
    }

    .btn-hacker:hover {
        background-color: #2ecc71;
        box-shadow: 0 0 15px #2ecc71;
    }

    .spinner-border {
        color: #000;
    }
</style>

<div class="container">
    <div class="email-card text-center">
        <h4><i class="fas fa-envelope me-2"></i> Confirm Your Email for order follow-up</h4>

        <form action="{{ route('paypal.capture.email') }}" method="POST" id="emailForm">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required autofocus>
            </div>
            <button type="submit" class="btn btn-hacker w-100" id="submitBtn">
                <span id="submitText"><i class="fas fa-paper-plane me-1"></i>Proceed to Checkout</span>
                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>
        </form>
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

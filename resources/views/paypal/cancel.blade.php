@extends('layouts.app')

@section('content')
<style>
    .cancel-wrapper {
        background: rgba(23, 25, 30, 0.95);
        padding: 50px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 0 20px rgba(255, 78, 78, 0.2);
        color: #e4e4e4;
    }

    .cancel-wrapper h1 {
        color: #ff4e4e;
        font-size: 2rem;
        text-shadow: 0 0 5px #ff4e4e;
    }

    .cancel-wrapper p {
        font-size: 1.1rem;
        color: #bbbbbb;
    }

    .btn-return {
        background-color: transparent;
        border: 1px solid #999;
        color: #ddd;
        transition: 0.2s ease-in-out;
    }

    .btn-return:hover {
        background-color: #2a2a2a;
        color: #39ff14;
        border-color: #39ff14;
        box-shadow: 0 0 10px #39ff14;
    }
</style>

<div class="container py-5">
    <div class="cancel-wrapper mx-auto" style="max-width: 600px;">
        <h1>❌ Payment Cancelled</h1>
        <p>Your transaction was cancelled. No payment was processed.</p>

        <a href="{{ route('home') }}" class="btn btn-return mt-4">
            <i class="fas fa-store me-2"></i> Return to Store
        </a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<style>
    .success-wrapper {
        max-width: 600px;
        margin: 80px auto;
        padding: 50px;
        background: rgba(23, 25, 30, 0.95);
        border-radius: 16px;
        text-align: center;
        color: #e4e4e4;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.1);
    }

    .success-wrapper h1 {
        color: #39ff14;
        font-size: 2rem;
        margin-bottom: 15px;
        text-shadow: 0 0 5px #39ff14;
    }

    .success-wrapper p {
        font-size: 1.1rem;
        color: #ccc;
    }

    .btn-back {
        background-color: #39ff14;
        color: #000;
        font-weight: bold;
        border: none;
        margin-top: 25px;
        box-shadow: 0 0 10px #39ff14;
        transition: 0.2s ease-in-out;
    }

    .btn-back:hover {
        background-color: #2ecc71;
        box-shadow: 0 0 15px #2ecc71;
        color: #000;
    }
</style>

<div class="container">
    <div class="success-wrapper">
        <h1><i class="fas fa-check-circle me-2"></i> Payment Successful!</h1>
        <p>Thank you for your purchase. Your transaction has been completed successfully.</p>

        <a href="{{ route('home') }}" class="btn btn-back">
            <i class="fas fa-store me-1"></i> Back to Shop
        </a>
    </div>
</div>
@endsection

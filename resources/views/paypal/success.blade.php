@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="display-5 text-success mb-3">🎉 Payment Successful!</h1>
    <p class="lead">Thank you for your purchase. Your transaction has been completed.</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-4">
        <i class="fas fa-arrow-left me-1"></i> Back to Shop
    </a>
</div>
@endsection

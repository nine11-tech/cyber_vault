@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="display-6 text-danger mb-3">❌ Payment Cancelled</h1>
    <p class="lead">Your transaction was cancelled. No payment was processed.</p>

    <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-4">
        <i class="fas fa-store me-1"></i> Return to Store
    </a>
</div>
@endsection

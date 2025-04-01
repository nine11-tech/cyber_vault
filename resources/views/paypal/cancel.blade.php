@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-danger">❌ Payment Cancelled</h3>
    <p>Your transaction was cancelled.</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Shop</a>
</div>
@endsection

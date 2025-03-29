@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-success">🎉 Payment Successful!</h3>
    <p>Thank you for your purchase.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Shop</a>
</div>
@endsection

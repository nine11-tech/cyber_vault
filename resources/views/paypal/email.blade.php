@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Enter Your Email Before Checkout</h2>

    <form action="{{ route('paypal.capture.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email">Email Address:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
    </form>
</div>
@endsection

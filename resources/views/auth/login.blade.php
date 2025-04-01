@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-4">
                    <h2 class="mb-1">Welcome Back!</h2>
                    <p class="mb-0">Sign in to continue</p>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                    placeholder="name@example.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                    placeholder="Enter password" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="#!" class="text-decoration-none small">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>

                        <div class="text-center position-relative my-4">
                            <hr class="my-3">
                            <span class="px-3 bg-white position-absolute top-50 start-50 translate-middle text-muted small">
                                Or continue with
                            </span>
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <a href="#" class="btn btn-outline-dark w-100">
                                    <i class="fab fa-google me-2"></i>Google
                                </a>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-outline-dark w-100">
                                    <i class="fab fa-facebook me-2"></i>Facebook
                                </a>
                            </div>
                        </div>

                        <p class="text-center mt-4 mb-0">Don't have an account? 
                            <a href="/register" class="text-decoration-none">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
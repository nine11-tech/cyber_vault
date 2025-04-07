@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom right, #0f0f0f, #1a1a1a);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .auth-card {
        max-width: 420px;
        margin: 60px auto;
        padding: 30px;
        background: rgba(23, 25, 30, 0.95);
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(57, 255, 20, 0.3);
        backdrop-filter: blur(5px);
        color: #e4e4e4;
    }

    .auth-card h2 {
        font-weight: 600;
        font-size: 26px;
        color: #39ff14;
        text-align: center;
        margin-bottom: 25px;
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
        color: #0f0f0f;
        font-weight: 600;
        transition: 0.2s ease-in-out;
        box-shadow: 0 0 10px #39ff14;
    }

    .btn-hacker:hover {
        background-color: #2ee70b;
        box-shadow: 0 0 15px #39ff14, 0 0 10px #39ff14;
    }

    .auth-footer {
        text-align: center;
        margin-top: 20px;
    }

    .auth-footer a {
        color: #39ff14;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    .forgot-link {
        color: #bbbbbb;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
        color: #39ff14;
    }

    .form-check-input:checked {
        background-color: #39ff14;
        border-color: #39ff14;
    }
</style>

<div class="auth-card">
    <h2>Welcome Back</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" class="form-control" name="email" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
            <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-hacker">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </button>
        </div>
    </form>

    <div class="auth-footer mt-4">
        Don't have an account?
        <a href="{{ route('register') }}">Sign Up</a>
    </div>
</div>
@endsection

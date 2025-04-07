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
        margin-top: 15px;
    }

    .auth-footer a {
        color: #39ff14;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-card">
    <h2>Create Account</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" class="form-control" name="name" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-hacker">
                <i class="fas fa-user-plus me-2"></i> Create Account
            </button>
        </div>
    </form>

    <div class="auth-footer mt-3">
        Already have an account?
        <a href="{{ route('login') }}">Sign In</a>
    </div>
</div>
@endsection

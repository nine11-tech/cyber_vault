@extends('layouts.app')

@section('content')
    <h2>Register</h2>

    @if (session(key: 'success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        <br>

        <button type="submit">Register</button>
    </form>
@endsection

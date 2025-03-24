@extends('layouts.app')

@section('content')
    <h2>Login</h2>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>

        <button type="submit">Login</button>
    </form>
@endsection


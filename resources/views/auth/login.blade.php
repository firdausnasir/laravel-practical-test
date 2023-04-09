@extends('layout')

@section('title', 'Login')

@section('content')
    <h3>Login</h3>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Login</button>
    </form>
@endsection
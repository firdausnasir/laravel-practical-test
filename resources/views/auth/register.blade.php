@extends('layout')

@section('title', 'Register')

@section('content')
    <h3>Register</h3>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

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

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Register</button>
    </form>
@endsection
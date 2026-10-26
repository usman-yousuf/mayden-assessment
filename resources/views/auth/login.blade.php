@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container">

    <h2>Login to Your Account</h2>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email">

            @error('email')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">

            @error('password')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p>
        Don't have an account?
        <a href="{{ route('register') }}">Create an Account</a>
    </p>

</div>

@endsection

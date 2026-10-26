@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container">

    <h2>Create an Account</h2>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="255">

            @error('name')
                <div class="validation-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="255">

            @error('email')
                <div class="validation-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required minlength="8" autocomplete="new-password">

            @error('password')
                <div class="validation-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Create Account</button>

    </form>
    
    <p class="auth-link">
        Already have an account?
        <a href="{{ route('login') }}">Log in</a>
    </p>
</div>

@endsection

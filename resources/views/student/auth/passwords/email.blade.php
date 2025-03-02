@extends('student.layouts.auth')

@section('title', 'Reset Password')

@push('styles')
    <link rel="stylesheet" href="{{ asset('student/css/auth.css') }}">
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        {{-- <div class="auth-logo">
            <img src="{{ asset('assets/images/logo-full.png') }}" alt="Logo">
        </div> --}}

        <h1 class="auth-title">Reset Password</h1>
        <p class="auth-subtitle">Enter your email to reset your password</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.forgot.request') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input class="form-control @error('email') is-invalid @enderror"
                       type="email" name="email"
                       placeholder="Enter your email address"
                       value="{{ old('email') }}" required autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Send Reset Link</button>

            <div class="auth-links">
                <a href="{{ route('student.login') }}">Back to login</a>
            </div>
        </form>
    </div>
</div>
@endsection

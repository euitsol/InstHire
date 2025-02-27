@extends('student.layouts.auth')

@section('title', 'Student Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('student/css/auth.css') }}">
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('assets/images/logo-full.png') }}" alt="Logo">
        </div>
        
        <h1 class="auth-title">Welcome back!</h1>
        <p class="auth-subtitle">Sign in to your student account to continue</p>

        <form method="POST" action="{{ route('student.login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" 
                       type="email" name="email" placeholder="Enter your email" 
                       value="{{ old('email') }}" required autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="password-field-wrapper">
                    <input class="form-control @error('password') is-invalid @enderror" 
                           type="password" name="password" id="password" 
                           placeholder="Enter your password" required />
                    <button type="button" class="password-toggle-btn">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" 
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>

            <div class="auth-links">
                <a href="{{ route('student.forgot') }}">Forgot password?</a>
            </div>
        </form>

        <div class="auth-links">
            <p>
                Don't have an account? 
                <a href="{{ route('student.register') }}">Sign up</a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('student/js/auth.js') }}"></script>
@endpush
@endsection

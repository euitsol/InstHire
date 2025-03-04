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

            <h1 class="auth-title">Set New Password</h1>
            <p class="auth-subtitle">Choose a strong password for your account</p>

            <form method="POST" action="{{ route('student.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" placeholder="Enter your email address" required readonly />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <div class="password-field-wrapper">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Enter new password" required autofocus>
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
                    <label class="form-label">Confirm New Password</label>
                    <div class="password-field-wrapper">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm new password" required>
                        <button type="button" class="password-toggle-btn">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>

                <div class="auth-links">
                    <a href="{{ route('student.login') }}">Back to login</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('student/js/auth.js') }}"></script>
    @endpush
@endsection

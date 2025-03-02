@extends('employee.layouts.master')

@section('title', 'Employee Forgot Password')

@section('content')
<div class="auth-wrapper">
    <div class="auth-background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="auth-container">
        <div class="auth-card">
            <div class="card-body">
                <!-- Logo -->
                <div class="text-center mb-4">
                    {{-- <img src="{{ asset('employee/images/logo.png') }}" alt="{{ config('app.name') }}" class="mb-4" height="48"> --}}
                    <h1 class="auth-title">{{ config('app.name') }}</h1>
                    <p class="auth-subtitle mb-0">{{ __('Enter your email address to reset your password') }}</p>
                </div>

                <form action="{{ route('employee.forgot.request') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            placeholder="name@example.com"
                            value="{{ old('email') }}"
                            required>
                        <label for="email">Email Address</label>
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>



                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary w-100 py-3">
                        {{ __('Send Password Reset Link') }} <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --primary-color: #4361ee;
    --primary-dark: #3046c9;
    --primary-light: transparent;
}

.auth-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: transparent;
}

.auth-background {
    display: none;
}

.auth-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 600px;
    margin: 0 1rem;
}

.auth-card {
    background: rgba(var(--bs-body-bg-rgb), 0.65);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
}

.auth-card .card-body {
    padding: 2.5rem;
}

.auth-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--bs-heading-color);
    letter-spacing: -0.025em;
}

.auth-subtitle {
    color: var(--bs-secondary-color);
    font-size: 0.875rem;
}

.form-floating > .form-control {
    border-radius: 0.75rem;
    border-color: rgba(var(--bs-body-color-rgb), 0.1);
    background-color: rgba(var(--bs-body-bg-rgb), 0.5);
    backdrop-filter: blur(4px);
}

.form-floating > .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    background-color: rgba(var(--bs-body-bg-rgb), 0.8);
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    z-index: 4;
    background: none;
    border: none;
    color: var(--bs-secondary-color);
    padding: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    transition: color 0.2s ease;
}

.password-toggle:hover {
    color: var(--primary-color);
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    border-radius: 0.75rem;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
    transform: translateY(-1px);
}

.btn-primary:active {
    transform: translateY(0);
}

@media (max-width: 767.98px) {
    .auth-card .card-body {
        padding: 1.5rem;
    }
}

[data-bs-theme="dark"] {
    --primary-light: transparent;
}

[data-bs-theme="dark"] .auth-card {
    background: rgba(30, 41, 59, 0.65);
}

[data-bs-theme="dark"] .form-floating > .form-control {
    background-color: rgba(15, 23, 42, 0.5);
}

[data-bs-theme="dark"] .form-floating > .form-control:focus {
    background-color: rgba(15, 23, 42, 0.8);
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.querySelector('.password-toggle i');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>
@endpush

@extends('employee.layouts.master')

@section('title', 'Employee Login')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="auth-card card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <img src="{{ asset('employee/images/logo.png') }}" alt="{{ config('app.name') }}" class="mb-4" height="48">
                            <h1 class="auth-title">Welcome Back!</h1>
                            <p class="auth-subtitle mb-0">Please sign in to continue</p>
                        </div>

                        <form action="{{ route('employee.login.submit') }}" method="POST">
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
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Enter password"
                                    required>
                                <label for="password">Password</label>
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none">Forgot Password?</a>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary w-100 py-3">
                                Sign In <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --primary-color: #4361ee;
    --primary-color-dark: #3046c9;
}

.auth-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
}

.auth-card {
    background: var(--bs-body-bg);
    border: none;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.auth-card .card-body {
    padding: 2.5rem;
}

.auth-title {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--bs-heading-color);
}

.auth-subtitle {
    color: var(--bs-secondary-color);
    font-size: 0.875rem;
}

.form-floating > .form-control {
    border-radius: 0.5rem;
    border-color: var(--bs-border-color);
}

.form-floating > .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
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
}

.btn-primary:hover {
    background-color: var(--primary-color-dark);
    border-color: var(--primary-color-dark);
}

@media (max-width: 767.98px) {
    .auth-card .card-body {
        padding: 1.5rem;
    }
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

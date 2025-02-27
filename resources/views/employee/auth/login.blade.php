@extends('employee.layouts.master')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid mb-4" style="height: 48px;">
                        <h4 class="mb-1">Welcome back!</h4>
                        <p class="text-muted small">Please sign in to continue.</p>
                    </div>

                    <form action="{{ route('employee.login.submit') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small">Email Address</label>
                            <input type="email" 
                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small">Password</label>
                            <div class="input-group">
                                <input type="password" 
                                    class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                    id="password" 
                                    name="password" 
                                    required>
                                <button type="button" class="btn btn-lg btn-outline-secondary" onclick="togglePassword()">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="remember">Remember me</label>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.querySelector('#password + button i');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
@endpush
@endsection

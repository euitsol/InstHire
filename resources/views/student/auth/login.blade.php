@extends('student.layouts.auth')

@section('title', 'Student Login')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center mt-4">
            <h1 class="h2">Welcome back!</h1>
            <p class="lead">
                Sign in to your student account to continue
            </p>
        </div>

        <div class="m-sm-4">
            <form method="POST" action="{{ route('student.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" 
                           type="email" name="email" placeholder="Enter your email" 
                           value="{{ old('email') }}" required autofocus />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" 
                               type="password" name="password" id="password" 
                               placeholder="Enter your password" required />
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" 
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('student.forgot') }}" class="text-decoration-none">
                        Forgot password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <p>
        Don't have an account? 
        <a href="{{ route('student.register') }}" class="text-decoration-none">Sign up</a>
    </p>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('#togglePassword').on('click', function() {
            const password = $('#password');
            const icon = $(this).find('i');
            
            if (password.attr('type') === 'password') {
                password.attr('type', 'text');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                password.attr('type', 'password');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    });
</script>
@endpush
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Admin Password Reset') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin_login.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif

            @if (session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif

            @if (session('warning'))
                showAlert('warning', '{{ session('warning') }}');
            @endif
        });
    </script>
</head>

<body>
    <div class="main_section">
        <div class="container position-relative">
            <a href="{{ route('home') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>{{ __('Back to Home') }}</span>
            </a>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-container">
                        <div class="login-header">
                            <h1>{{ config('app.name') }}</h1>
                            <p>{{ __('Enter your new password to reset your password') }}</p>
                        </div>
                        <form action="{{ route('admin.reset.request') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3 form-floating">
                                <input type="email" value="{{ request('email') }}" name="email"
                                    class="form-control" id="email" placeholder="Email" required>
                                <label for="email">{{ __('Email address') }}</label>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="password" value="{{ old('password') }}" name="password"
                                    class="form-control" id="password" placeholder="New Password" required>
                                <label for="email">{{ __('New Password') }}</label>
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="password" value="{{ old('password_confirmation') }}"
                                    name="password_confirmation" class="form-control" id="con_password"
                                    placeholder="Confirm Password" required>
                                <label for="con_password">{{ __('Confirm Password') }}</label>
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>
                            <button type="submit" class="btn btn-login">{{ __('Reset Password') }}</button>
                        </form>
                        <div class="divider">
                            <span>{{ __('or') }}</span>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

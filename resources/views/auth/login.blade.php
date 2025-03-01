{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstHire - Choose Your Role</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --hover-color: #1d4ed8;
            --bg-color: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        body {
            background: var(--bg-color);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .main-container {
            padding: 2rem 0;
        }

        .header-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header-section h1 {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .header-section p {
            color: #64748b;
            font-size: 1.1rem;
        }

        .user-type-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .user-type-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .user-type-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow);
        }

        .user-type-card:hover::before {
            transform: scaleX(1);
        }

        .card-body {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: #eff6ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-wrapper i {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .card-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .role-btn {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .role-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }

            .header-section {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container main-container">
        <div class="header-section">
            <h1>Welcome to InstHire</h1>
            <p>Select your role to get started with our platform</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Admin Card -->
            <div class="col-xl-3 col-6">
                <a href="{{ route('admin.login') }}" class="text-decoration-none">
                    <div class="user-type-card">
                        <div class="card-body">
                            <div class="icon-wrapper">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Manage platform activities</p>
                            <button class="role-btn">Continue as Admin</button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Institute Card -->
            <div class="col-xl-3 col-6">
                <a href="{{ route('institute.login') }}" class="text-decoration-none">
                    <div class="user-type-card">
                        <div class="card-body">
                            <div class="icon-wrapper">
                                <i class="fas fa-university"></i>
                            </div>
                            <h5 class="card-title">Institute</h5>
                            <p class="card-text">Post jobs and manage your institution</p>
                            <button class="role-btn">Continue as Institute</button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Employee Card -->
            <div class="col-xl-3 col-6">
                <a href="{{ route('employee.login') }}" class="text-decoration-none">
                    <div class="user-type-card">
                        <div class="card-body">
                            <div class="icon-wrapper">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h5 class="card-title">Employee</h5>
                            <p class="card-text">Manage your work and assignments</p>
                            <button class="role-btn">Continue as Employee</button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Job Seeker Card -->
            <div class="col-xl-3 col-6">
                <a href="{{ route('student.login') }}" class="text-decoration-none">
                    <div class="user-type-card">
                        <div class="card-body">
                            <div class="icon-wrapper">
                                <i class="fas fa-search"></i>
                            </div>
                            <h5 class="card-title">Job Seeker</h5>
                            <p class="card-text">Find and apply for opportunities</p>
                            <button class="role-btn">Continue as Job Seeker</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

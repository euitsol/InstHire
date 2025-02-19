@extends('institute.layouts.master')

@section('title', 'Reset Password')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center  mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card stats-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h4 class="mb-2">Reset Password</h4>
                            <p class="text-muted">Enter your email to receive password reset link</p>
                        </div>
                        <form method="POST" action="{{ route('institute.password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Send Reset Link
                                </button>
                                <a href="{{ route('institute.login') }}" class="btn btn-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                                    </svg>
                                    Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

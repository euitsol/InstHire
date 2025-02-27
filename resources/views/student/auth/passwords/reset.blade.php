@extends('student.layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center mt-4">
            <h1 class="h2">Reset password</h1>
            <p class="lead">
                Choose a new password for your account.
            </p>
        </div>

        <div class="m-sm-4">
            <form method="POST" action="{{ route('student.reset.request') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" 
                           type="email" name="email" placeholder="Enter your email" 
                           value="{{ $email ?? old('email') }}" required readonly />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input class="form-control form-control-lg @error('password') is-invalid @enderror" 
                           type="password" name="password" placeholder="Enter new password" required />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input class="form-control form-control-lg" type="password" 
                           name="password_confirmation" placeholder="Confirm new password" required />
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Reset password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

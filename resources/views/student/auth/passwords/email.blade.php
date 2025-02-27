@extends('student.layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="text-center mt-4">
            <h1 class="h2">Reset password</h1>
            <p class="lead">
                Enter your email to reset your password.
            </p>
        </div>

        <div class="m-sm-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('student.forgot.request') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control form-control-lg @error('email') is-invalid @enderror" 
                           type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Reset password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

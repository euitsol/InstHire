@extends('student.layouts.auth')

@section('title', 'Student Registration')

@push('styles')
    <link rel="stylesheet" href="{{ asset('student/css/auth.css') }}">
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('assets/images/logo-full.png') }}" alt="Logo">
        </div>
        
        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Join our student community today</p>

        <form method="POST" action="{{ route('student.register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                       name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Select Institute</label>
                <select class="form-control @error('institute_id') is-invalid @enderror"
                        name="institute_id" id="institute_id" required>
                    <option value="">Select your institute</option>
                    @foreach($institutes as $institute)
                        <option value="{{ $institute->id }}"
                            {{ old('institute_id') == $institute->id ? 'selected' : '' }}>
                            {{ $institute->name }}
                        </option>
                    @endforeach
                </select>
                @error('institute_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Select Department</label>
                <select class="form-control @error('department_id') is-invalid @enderror"
                        name="department_id" id="department_id" required>
                    <option value="">Select your department</option>
                </select>
                @error('department_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="password-field-wrapper">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="Create a password" required>
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
                <label class="form-label">Confirm Password</label>
                <div class="password-field-wrapper">
                    <input type="password" class="form-control"
                           name="password_confirmation" placeholder="Confirm your password" required>
                    <button type="button" class="password-toggle-btn">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>

        <div class="auth-links">
            <p>
                Already have an account? 
                <a href="{{ route('student.login') }}">Sign in</a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('student/js/auth.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#institute_id').on('change', function() {
                var instituteId = $(this).val();
                if(instituteId) {
                    var url = "{{ route('student.departments', '_institute_id') }}";
                    url = url.replace('_institute_id', instituteId);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            console.log(data);
                            $('#department_id').empty();
                            $('#department_id').append('<option value="">Select Department</option>');
                            $.each(data, function(key, value) {
                                console.log(value);
                                $('#department_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                    var sessionUrl = "{{ route('student.sessions', '_institute_id') }}";
                    sessionUrl = sessionUrl.replace('_institute_id', instituteId);
                    $.ajax({
                        url: sessionUrl,
                        type: 'GET',
                        data: { institute_id: instituteId },
                        success: function(data) {
                            console.log(data);
                            $('#session_id').empty();
                            $('#session_id').append('<option value="">Select Session</option>');
                            $.each(data, function(key, value) {
                                console.log(value);
                                $('#session_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                }else {
                    $('#department_id').empty();
                    $('#department_id').append('<option value="">Select Department</option>');
                    $('#session_id').empty();
                    $('#session_id').append('<option value="">Select Session</option>');
                }
            });
        });
    </script>
@endpush
@endsection

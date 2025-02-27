@extends('student.layouts.auth')

@section('title', 'Student Registration')

@section('content')
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center">
        <div class="col-md-8">
            <div class="authincation-content">
                <div class="row no-gutters">
                    <div class="col-xl-12">
                        <div class="auth-form">
                            <div class="mb-3 text-center">
                                <a href="{{ route('login_stater') }}">
                                    <img src="{{ asset('assets/images/logo-full.png') }}" alt="">
                                </a>
                            </div>
                            <h4 class="mb-4 text-center">Sign up your account</h4>
                            <form method="POST" action="{{ route('student.register') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="mb-1"><strong>Name</strong></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Email</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Phone</strong></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Institute</strong></label>
                                    <select class="form-control @error('institute_id') is-invalid @enderror"
                                            name="institute_id" id="institute_id" required>
                                        <option value="">Select Institute</option>
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
                                    <label class="mb-1"><strong>Department</strong></label>
                                    <select class="form-control @error('department_id') is-invalid @enderror"
                                            name="department_id" id="department_id" required>
                                        <option value="">Select Department</option>
                                    </select>
                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Session</strong></label>
                                    <select class="form-control @error('session_id') is-invalid @enderror"
                                            name="session_id" id="session_id" required>
                                        <option value="">Select Session</option>
                                    </select>
                                    @error('session_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Password</strong></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mb-1"><strong>Confirm Password</strong></label>
                                    <input type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                                </div>
                            </form>
                            <div class="mt-3 new-account">
                                <p>Already have an account? <a class="text-primary" href="{{ route('student.login') }}">Sign in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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

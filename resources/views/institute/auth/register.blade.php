@extends('institute.layouts.master')

@section('title', 'Register')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-8 col-lg-6">
                <div class="card stats-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h4 class="mb-2">Create Account</h4>
                            <p class="text-muted">Register your institute with us</p>
                        </div>

                        <form method="POST" action="{{ route('institute.register.submit') }}" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Institute Name</label>
                                    <input type="text" placeholder="Institute Name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" placeholder="Email Address"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" required>
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="responsible_person_name" class="form-label">Responsible Person Name</label>
                                    <input type="text" placeholder="Responsible Person Name"
                                        class="form-control @error('responsible_person_name') is-invalid @enderror"
                                        id="responsible_person_name" name="responsible_person_name"
                                        value="{{ old('responsible_person_name') }}" required>
                                    @include('alerts.feedback', ['field' => 'responsible_person_name'])
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="responsible_person_phone" class="form-label">Responsible Person Phone
                                        Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+880</span>
                                        <input type="tel"
                                            class="form-control @error('responsible_person_phone') is-invalid @enderror"
                                            id="responsible_person_phone" name="responsible_person_phone"
                                            value="{{ old('responsible_person_phone') }}" required pattern="[0-9]{10}"
                                            placeholder="1XXXXXXXXX">
                                        @include('alerts.feedback', [
                                            'field' => 'responsible_person_phone',
                                        ])
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" placeholder="Password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" placeholder="Confirm Password" class="form-control"
                                            id="password_confirmation" name="password_confirmation" required>
                                        <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                        id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a
                                            href="#" class="text-primary">Privacy Policy</a>
                                    </label>
                                    @error('terms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Register
                                </button>
                                <p class="text-center mt-3">Already have an account? <a
                                        href="{{ route('institute.login') }}"
                                        class="text-primary text-decoration-none">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Toggle password visibility
                function togglePasswordVisibility(buttonId, inputId) {
                    $(buttonId).on('click', function() {
                        const input = $(inputId);
                        const type = input.attr('type') === 'password' ? 'text' : 'password';
                        input.attr('type', type);

                        // Update icon based on password visibility
                        const icon = $(this).find('svg');
                        if (type === 'text') {
                            icon.html(
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />'
                            );
                        } else {
                            icon.html(
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />'
                            );
                        }
                    });
                }

                // Initialize password toggles
                togglePasswordVisibility('#togglePassword', '#password');
                togglePasswordVisibility('#toggleConfirmPassword', '#password_confirmation');

                // Phone number validation
                $('#phone').on('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length > 10) {
                        this.value = this.value.slice(0, 10);
                    }
                });
            });
        </script>
    @endpush
@endsection

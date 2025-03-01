@extends('employee.layouts.master')

@section('title', 'Security Settings')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-auto">
                    <h1 class="h3 mb-0">Security Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employee.profile') }}">Profile</a></li>
                            <li class="breadcrumb-item active">Security</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Change Password -->
            <div class="profile-card mb-4">
                <div class="card-header border-bottom p-4">
                    <div class="d-flex align-items-center">
                        <div class="profile-info-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-key"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Change Password</h5>
                            <p class="text-muted mb-0">Ensure your account is using a strong password</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('employee.profile.update-password') }}" method="POST" class="security-form">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">Current Password</label>
                            <div class="input-group input-group-lg">
                                <input type="password"
                                    name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    required>
                                <button type="button" class="btn btn-light password-toggle">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <div class="input-group input-group-lg">
                                <input type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required>
                                <button type="button" class="btn btn-light password-toggle">
                                    <i class="bi bi-eye-slash"></i>
                                </button>

                            </div>
                            @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            <div class="form-text mt-2">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bi bi-shield-check text-success me-2"></i>
                                    Password must be at least 8 characters
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bi bi-shield-check text-success me-2"></i>
                                    Include at least one uppercase & lowercase letter
                                </div>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bi bi-shield-check text-success me-2"></i>
                                    Include at least one number
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-check text-success me-2"></i>
                                    Include at least one special character
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <div class="input-group input-group-lg">
                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    required>
                                <button type="button" class="btn btn-light password-toggle">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-shield-lock me-2"></i>
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Login History -->
            {{-- <div class="card">
                <div class="card-header border-bottom p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Login History</h5>
                            <p class="text-muted mb-0">Your recent login activity</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Device</th>
                                    <th>Location</th>
                                    <th>IP Address</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-laptop fs-4 me-2"></i>
                                            Chrome on Windows
                                        </div>
                                    </td>
                                    <td>Dhaka, Bangladesh</td>
                                    <td>192.168.1.1</td>
                                    <td>2 minutes ago</td>
                                    <td>
                                        <span class="badge bg-success">Current Session</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-phone fs-4 me-2"></i>
                                            Safari on iPhone
                                        </div>
                                    </td>
                                    <td>Dhaka, Bangladesh</td>
                                    <td>192.168.1.2</td>
                                    <td>2 days ago</td>
                                    <td>
                                        <span class="badge bg-secondary">Expired</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>


       <!-- Security Tips -->
       <div class="col-12 col-lg-4">
        <div class="profile-card">
            <div class="card-header border-bottom p-4">
                <h5 class="mb-0">Security Tips</h5>
            </div>
            <ul class="security-tips-list">
                <li class="security-tip-item">
                    <div class="d-flex align-items-start">
                        <div class="security-tip-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <div>
                            <h6 class="mb-2">Use a Strong Password</h6>
                            <p class="text-muted mb-0">Create a unique password that's hard to guess but easy to remember. Avoid using common words or personal information.</p>
                        </div>
                    </div>
                </li>
                <li class="security-tip-item">
                    <div class="d-flex align-items-start">
                        <div class="security-tip-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div>
                            <h6 class="mb-2">Regular Updates</h6>
                            <p class="text-muted mb-0">Change your password periodically and never use the same password for multiple accounts.</p>
                        </div>
                    </div>
                </li>
                <li class="security-tip-item">
                    <div class="d-flex align-items-start">
                        <div class="security-tip-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-share"></i>
                        </div>
                        <div>
                            <h6 class="mb-2">Never Share Credentials</h6>
                            <p class="text-muted mb-0">Keep your login information private and never share it with others, even if they claim to be from our team.</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    // Password visibility toggle
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        });
    });

    // Password form validation
    const passwordForm = document.querySelector('.password-form');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            const newPassword = this.querySelector('input[name="password"]').value;
            const confirmPassword = this.querySelector('input[name="password_confirmation"]').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('New password and confirmation password do not match!');
                return;
            }

            // Password strength validation
            const hasUpperCase = /[A-Z]/.test(newPassword);
            const hasLowerCase = /[a-z]/.test(newPassword);
            const hasNumbers = /\d/.test(newPassword);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(newPassword);
            const isLongEnough = newPassword.length >= 8;

            if (!hasUpperCase || !hasLowerCase || !hasNumbers || !hasSpecialChar || !isLongEnough) {
                e.preventDefault();
                alert('Password does not meet the requirements!');
                return;
            }
        });
    }
</script>
@endpush

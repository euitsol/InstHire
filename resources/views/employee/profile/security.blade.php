@extends('employee.layouts.master')

@section('title', 'Security Settings')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Security Settings</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.profile') }}">Profile</a></li>
                    <li class="breadcrumb-item active">Security</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <!-- Change Password -->
            <div class="card mb-4">
                <div class="card-header border-bottom p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-key"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Change Password</h5>
                            <p class="text-muted mb-0">Ensure your account is using a strong password</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('employee.profile.update-password') }}" method="POST" class="password-form">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" name="current_password" class="form-control" required>
                                        <button type="button" class="btn btn-light password-toggle">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" required>
                                        <button type="button" class="btn btn-light password-toggle">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">
                                        Password must be at least 8 characters long and contain:
                                        <ul class="mb-0 ps-3">
                                            <li>At least one uppercase letter</li>
                                            <li>At least one lowercase letter</li>
                                            <li>At least one number</li>
                                            <li>At least one special character</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                        <button type="button" class="btn btn-light password-toggle">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
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
            <div class="card">
                <div class="card-header border-bottom p-4">
                    <h5 class="mb-0">Security Tips</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                                <i class="bi bi-shield-exclamation"></i>
                            </div>
                            <h6 class="mb-0">Use a Strong Password</h6>
                        </div>
                        <p class="text-muted mb-0">Create a unique password that's hard to guess but easy to remember.</p>
                    </div>

                    {{-- <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                                <i class="bi bi-phone-vibrate"></i>
                            </div>
                            <h6 class="mb-0">Enable Two-Factor Auth</h6>
                        </div>
                        <p class="text-muted mb-0">Add an extra layer of security to your account with 2FA.</p>
                    </div> --}}

                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">
                                <i class="bi bi-share"></i>
                            </div>
                            <h6 class="mb-0">Never Share Credentials</h6>
                        </div>
                        <p class="text-muted mb-0">Keep your login information private and never share it with others.</p>
                    </div>
                </div>
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

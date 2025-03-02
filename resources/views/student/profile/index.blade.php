@extends('student.layouts.master')

@section('title', 'Profile')

@section('content')
<div class="px-4 container-fluid">
    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">My Profile</h1>
            <p class="text-muted">Manage your personal and academic information</p>
        </div>
        <div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="row g-4">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4 rounded-xl shadow-sm card">
                    <div class="py-3 bg-white card-header border-bottom">
                        <h4 class="mb-1 card-title">Profile Information</h4>
                        <p class="mb-0 text-muted">Update your personal information</p>
                    </div>
                    <div class="card-body">
                        <!-- Profile Image -->
                        <div class="mb-4 text-center">
                            <div class="position-relative d-inline-block">
                                <img id="profileImagePreview" src="{{ $student->image ? $student->image : '' }}"
                                     alt="Profile Image"
                                     class="rounded-circle img-thumbnail"
                                     style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #f8f9fa;">
                                <label for="image" class="bottom-0 p-2 text-white cursor-pointer position-absolute end-0 bg-primary rounded-circle" style="cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                                <input type="file" name="image" id="image" class="d-none" accept="image/*" onchange="previewImage(this)">
                            </div>
                            @include('alerts.feedback', ['field' => 'image'])
                        </div>

                        <div class="row">
                            <!-- Name -->
                            <div class="mb-4 col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $student->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <!-- Email -->
                            <div class="mb-4 col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $student->email) }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <!-- Phone -->
                            <div class="mb-4 col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone"
                                    value="{{ old('phone', $student->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'phone'])
                            </div>

                            <!-- Gender -->
                            <div class="mb-4 col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="1" {{ old('gender', $student->gender) == 1 ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ old('gender', $student->gender) == 2 ? 'selected' : '' }}>Female</option>
                                    <option value="3" {{ old('gender', $student->gender) == 3 ? 'selected' : '' }}>Other</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'gender'])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 rounded-xl shadow-sm card">
                    <div class="py-3 bg-white card-header border-bottom">
                        <h4 class="mb-1 card-title">Academic Information</h4>
                        <p class="mb-0 text-muted">Your academic details</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Institute -->
                            <div class="mb-4 col-md-6">
                                <label class="form-label">Institute</label>
                                <input type="text" value="{{ $student->institute ? $student->institute->name : 'Not Assigned' }}"
                                    class="form-control" readonly>
                            </div>

                            <!-- Department -->
                            <div class="mb-4 col-md-6">
                                <label class="form-label">Department</label>
                                <input type="text" value="{{ $student->department ? $student->department->name : 'Not Assigned' }}"
                                    class="form-control" readonly>
                            </div>

                            <!-- Session -->
                            <div class="mb-4 col-md-4">
                                <label class="form-label">Session</label>
                                <input type="text" value="{{ $student->session ? $student->session->name : 'Not Assigned' }}"
                                    class="form-control" readonly>
                            </div>

                            <!-- Roll -->
                            <div class="mb-4 col-md-4">
                                <label for="roll" class="form-label">Roll Number</label>
                                <input type="text" name="roll" id="roll"
                                    value="{{ old('roll', $student->roll) }}"
                                    class="form-control @error('roll') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'roll'])
                            </div>

                            <!-- Registration -->
                            <div class="mb-4 col-md-4">
                                <label for="registration" class="form-label">Registration Number</label>
                                <input type="text" name="registration" id="registration"
                                    value="{{ old('registration', $student->registration) }}"
                                    class="form-control @error('registration') is-invalid @enderror">
                                @include('alerts.feedback', ['field' => 'registration'])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cloud-upload-fill me-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Account Actions & Status -->
        <div class="col-lg-4">
            <!-- Account Status -->
            <div class="mb-4 rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Account Status</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle bg-light">
                                <i class="bi bi-check-circle text-primary" style="font-size: 24px;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Verification Status</h5>
                            <span class="{{ $student->status_badge_color }}">
                                {{ $student->status_label }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="p-3 rounded-circle bg-light">
                                <i class="bi bi-clock-history text-primary" style="font-size: 24px;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Account Created</h5>
                            <p class="mb-0 text-muted">{{ timeFormat($student->created_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password -->
            <div class="mb-4 rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @include('alerts.feedback', ['field' => 'current_password'])
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-key-fill me-2"></i>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Actions -->
            <div class="rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Account Actions</h4>
                </div>
                <div class="card-body">
                    <div class="gap-3 d-grid">
                        <!-- Contact Support -->
                        <a href="#" class="btn btn-light d-flex align-items-center justify-content-between">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-envelope me-2 text-muted"></i>
                                Contact Support
                            </span>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush

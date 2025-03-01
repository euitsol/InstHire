@extends('employee.layouts.master')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-auto">
                    <h1 class="h3 mb-0">Profile Settings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Profile Info -->
            <div class="col-12 col-lg-4">
                <div class="profile-card">
                    <div class="card-body text-center p-4">
                        <div class="profile-photo mb-4">
                            @if(employee()->image)
                                <img src="{{ auth_storage_url(employee()->image) }}"
                                    alt="{{ employee()->name }}"
                                    class="profile-image">
                            @else
                                <div class="avatar-placeholder bg-primary text-white">
                                    {{ substr(employee()->name, 0, 1) }}
                                </div>
                            @endif
                            <button type="button" class="edit-photo-btn" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>

                        <h4 class="mb-1">{{ employee()->name }}</h4>
                        <p class="text-muted mb-3">{{ employee()->designation }}</p>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                            <i class="bi bi-pencil me-2"></i>
                            Edit Profile
                        </button>
                    </div>

                    <ul class="profile-info-list">
                        <li class="profile-info-item">
                            <div class="profile-info-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Email Address</small>
                                <span>{{ employee()->email }}</span>
                            </div>
                        </li>
                        <li class="profile-info-item">
                            <div class="profile-info-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Phone Number</small>
                                <span>{{ employee()->phone ?? 'Not set' }}</span>
                            </div>
                        </li>
                        <li class="profile-info-item">
                            <div class="profile-info-icon bg-info bg-opacity-10 text-info">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Gender</small>
                                <span>{{ employee()->gender_label ?? 'Not set' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Account Activity -->
            <div class="col-12 col-lg-8">
                <div class="card profile-card mb-4">
                    <div class="card-header border-bottom p-4">
                        <h5 class="mb-0">Account Activity</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="activity-card">
                            <div class="activity-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="activity-title">Security Settings</h6>
                                <p class="activity-subtitle">Manage your password and security preferences</p>
                            </div>
                            <a href="{{ route('employee.profile.security') }}" class="btn btn-primary">
                                Manage
                            </a>
                        </div>

                        <div class="activity-card">
                            <div class="activity-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-bell"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="activity-title">Notifications</h6>
                                <p class="activity-subtitle">Choose what notifications you want to receive</p>
                            </div>
                            <button type="button" class="btn btn-primary">
                                Manage
                            </button>
                        </div>

                        <div class="activity-card">
                            <div class="activity-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-trash"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="activity-title">Delete Account</h6>
                                <p class="activity-subtitle">Permanently delete your account and all data</p>
                            </div>
                            <button type="button" class="btn btn-outline-danger">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo Modal -->
<div class="modal fade" id="updatePhotoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('employee.profile.update-photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="image-preview rounded-circle mx-auto mb-3" style="width: 120px; height: 120px; background-size: cover; background-position: center;">
                            @if(employee()->image)
                                <img src="{{ auth_storage_url(employee()->image) }}" alt="{{ employee()->name }}" class="rounded-circle" width="120" height="120" style="object-fit: cover;">
                            @else
                                <div class="avatar-placeholder rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; font-size: 2.5rem;">
                                    {{ substr(employee()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Choose Photo</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <div class="form-text">Maximum file size: 2MB. Supported formats: JPG, PNG</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('employee.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ employee()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ employee()->email }}" readonly disabled>
                        <div class="form-text">Email cannot be changed</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control" value="{{ employee()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            @foreach(employee()->gender_labels as $key => $value)
                                <option value="{{ $key }}" {{ employee()->gender == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview uploaded image
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.querySelector('.image-preview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.style.backgroundImage = `url(${e.target.result})`;
                    imagePreview.innerHTML = '';
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endpush

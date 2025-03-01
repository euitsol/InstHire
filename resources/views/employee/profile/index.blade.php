@extends('employee.layouts.master')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Profile Settings</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Info -->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-4">
                        @if(employee()->image)
                            <img src="{{ auth_storage_url(employee()->image) }}"
                                alt="{{ employee()->name }}"
                                class="rounded-circle"
                                width="120" height="120"
                                style="object-fit: cover;">
                        @else
                            <div class="avatar-placeholder rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                style="width: 120px; height: 120px; font-size: 2.5rem;">
                                {{ substr(employee()->name, 0, 1) }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle p-2" data-bs-toggle="modal" data-bs-target="#updatePhotoModal">
                            <i class="bi bi-camera-fill"></i>
                        </button>
                    </div>

                    <h5 class="mb-1">{{ employee()->name }}</h5>
                    <p class="text-muted mb-3">{{ employee()->designation }}</p>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                            <i class="bi bi-pencil me-2"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>
                <div class="card-footer p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope text-muted me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <span>{{ employee()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone text-muted me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Phone</small>
                                    <span>{{ employee()->phone ?? 'Not set' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt text-muted me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Gender</small>
                                    <span>{{ employee()->gender_label ?? 'Not set' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Activity -->
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header border-bottom p-4">
                    <h5 class="mb-0">Account Activity</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center p-3 border rounded mb-3">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Security</h6>
                            <p class="text-muted mb-0">Manage your password and security preferences.</p>
                        </div>
                        <a href="{{ route('employee.profile.security') }}" class="btn btn-light ms-auto">
                            Manage
                        </a>
                    </div>

                    <div class="d-flex align-items-center p-3 border rounded mb-3">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Notifications</h6>
                            <p class="text-muted mb-0">Choose what notifications you want to receive.</p>
                        </div>
                        <button type="button" class="btn btn-light ms-auto">
                            Manage
                        </button>
                    </div>

                    <div class="d-flex align-items-center p-3 border rounded">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">
                            <i class="bi bi-trash"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Delete Account</h6>
                            <p class="text-muted mb-0">Permanently delete your account and all data.</p>
                        </div>
                        <button type="button" class="btn btn-outline-danger ms-auto">
                            Delete
                        </button>
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

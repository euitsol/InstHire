@extends('admin.layouts.master', ['page_slug' => 'profile'])
@section('title', 'Admin Profile')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createAdmin" class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">{{ __($admin->name . ' Profile') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'am.admin.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('am.admin.profile.update', $admin->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">{{ __('Basic Information') }}</h5>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Name') }}<span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $admin->name }}" class="form-control" name="name"
                                                    required>
                                                @include('alerts.feedback', ['field' => 'name'])
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Email') }}<span class="text-danger">*</span></label>
                                                <input type="email" value="{{ $admin->email }}" class="form-control" required disabled>
                                                @include('alerts.feedback', ['field' => 'email'])
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Phone') }}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+880</span>
                                                    <input type="text" min='11' max='11' pattern="[0-9]{11}"
                                                        placeholder="Enter phone" value="{{ $admin->phone }}" class="form-control"
                                                        name="phone">
                                                </div>
                                                @include('alerts.feedback', ['field' => 'phone'])
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Gender') }}</label>
                                                <select class="form-select" name="gender">
                                                    <option value=" " selected disabled>
                                                        {{ __('Select Gender') }}</option>
                                                    @foreach ($admin->gender_labels as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ $admin->gender == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @include('alerts.feedback', ['field' => 'gender'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">{{ __('Profile Image') }}</h5>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Upload Image') }}</label>
                                                <input type="file" accept="image/*" class="form-control" name="image">
                                                @include('alerts.feedback', ['field' => 'image'])
                                                <div class="form-text text-muted">
                                                    {{ __('Recommended size: 800x600px. Max size: 2MB') }}
                                                </div>
                                            </div>
                                            <div class="image-preview mt-3 {{ $admin->image ? '' : 'd-none' }}">
                                                <img src="{{ $admin->image ? asset('storage/'.$admin->image) : '' }}" alt="Profile Preview" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Update Profile') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Image preview
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const preview = document.querySelector('.image-preview');
        const img = preview.querySelector('img');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            // If no new file is selected and there's an existing image, keep showing it
            if (!img.getAttribute('src')) {
                preview.classList.add('d-none');
            }
        }
    });
</script>
@endpush

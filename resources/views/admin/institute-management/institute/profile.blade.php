@extends('admin.layouts.master', ['page_slug' => 'institute'])
@section('title', 'Institute Profile')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="createAdmin" class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">{{ __($institute->name . ' Profile') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'im.institute.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('im.institute.profile.update', $institute->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">{{ __('Basic Information') }}</h5>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Name') }}<span class="text-danger">*</span> </label>
                                                <input type="text" placeholder="Enter name" value="{{ $institute->name }}" class="form-control" name="name"
                                                    required>
                                                @include('alerts.feedback', ['field' => 'name'])
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Slug') }}</label>
                                                <input type="text" value="{{ $institute->slug }}" class="form-control" required disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Email') }}</label>
                                                <input type="email" value="{{ $institute->email }}" class="form-control" required disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Valid To') }}</label>
                                                <input type="text" value="{{ $institute->valid_to }}" class="form-control" required disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Responsible Person Name') }}<span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $institute->responsible_person_name }}" placeholder="Enter responsible person name" name="responsible_person_name" class="form-control" required>
                                                @include('alerts.feedback', ['field' => 'responsible_person_name'])
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Responsible Person Phone') }}<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+880</span>
                                                    <input type="text" min='11' max='11' pattern="[0-9]{11}"
                                                        placeholder="Enter phone" value="{{ $institute->responsible_person_phone }}" class="form-control"
                                                        name="responsible_person_phone" required>
                                                </div>
                                                @include('alerts.feedback', ['field' => 'responsible_person_phone'])
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Created By') }}</label>
                                                <input type="text" value="{{ $institute->creater ? $institute->creater->name : 'System' }}" class="form-control" required disabled>
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
                                            <div class="image-preview mt-3 {{ $institute->image ? '' : 'd-none' }}">
                                                <img src="{{ $institute->image ? $institute->image : '' }}" alt="Profile Preview" class="img-fluid rounded">
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

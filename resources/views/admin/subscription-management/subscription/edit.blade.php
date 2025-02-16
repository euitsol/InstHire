@extends('admin.layouts.master', ['page_slug' => 'subscription'])
@section('title', 'Edit Subscription')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">{{ __('Edit Subscription') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'sm.subscription.index',
                                'label' => 'Back',
                            ])
                        </div>
                        <form action="{{ route('sm.subscription.update', $subscription->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">{{ __('Basic Information') }}</h5>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Title') }}</label>
                                                <input type="text" value="{{ old('title', $subscription->title) }}" class="form-control" name="title" required>
                                                @include('alerts.feedback', ['field' => 'title'])
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('Price (BDT)') }}</label>
                                                        <div class="input-group">
                                                            <input type="number" step="0.01" value="{{ old('price', $subscription->price) }}" class="form-control" name="price" required>
                                                            <span class="input-group-text">BDT</span>
                                                        </div>
                                                        @include('alerts.feedback', ['field' => 'price'])
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('Validity') }}</label>
                                                        <div class="input-group">
                                                            <input type="number" value="{{ old('validity', $subscription->validity) }}" class="form-control" name="validity" required>
                                                            <span class="input-group-text">Days</span>
                                                        </div>
                                                        @include('alerts.feedback', ['field' => 'validity'])
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-0">
                                                <label class="form-label">{{ __('Description') }}</label>
                                                <textarea class="form-control" name="description" rows="4" placeholder="Enter subscription description...">{{ old('description', $subscription->description) }}</textarea>
                                                @include('alerts.feedback', ['field' => 'description'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">{{ __('Subscription Image') }}</h5>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Upload Image') }}</label>
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                                @include('alerts.feedback', ['field' => 'image'])
                                                <div class="form-text text-muted">
                                                    {{ __('Recommended size: 800x600px. Max size: 2MB') }}
                                                </div>
                                            </div>
                                            <div class="image-preview mt-3 {{ $subscription->image ? '' : 'd-none' }}">
                                                <img src="{{ $subscription->image }}" alt="Preview" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Update Subscription') }}
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
        }
    });
</script>
@endpush

@extends('institute.layouts.master')
@section('title', 'Create Stall Option')
@section('content')
    <!-- Stall Option Create -->
    <div class="mb-4 card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="mb-4 card-title">{{ __('Create Stall Option') }}</h2>
                <a href="{{ route('institute.setup.jfs.list') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>

            <form action="{{ route('institute.setup.jfs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="stall_size" class="form-label">Stall Size</label><small class="text-danger">*</small>
                    <input type="text" class="form-control" value="{{ old('stall_size') }}" placeholder="Enter stall size"
                        id="stall_size" name="stall_size">
                    @include('alerts.feedback', ['field' => 'stall_size'])
                </div>

                <div class="mb-3">
                    <label for="maximum_representative" class="form-label">Maximum Representatives</label><small class="text-danger">*</small>
                    <input type="number" class="form-control" value="{{ old('maximum_representative') }}"
                        placeholder="Enter maximum representatives" id="maximum_representative" name="maximum_representative" min="1">
                    @include('alerts.feedback', ['field' => 'maximum_representative'])
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        placeholder="Enter description">{{ old('description') }}</textarea>
                    @include('alerts.feedback', ['field' => 'description'])
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label><small class="text-danger">*</small>
                    <select name="status" id="status" class="form-control">
                        <option value="{{ App\Models\JobFairStallOption::STATUS_ACTIVE }}" {{ old('status') == App\Models\JobFairStallOption::STATUS_ACTIVE ? 'selected' : '' }}>Active</option>
                        <option value="{{ App\Models\JobFairStallOption::STATUS_INACTIVE }}" {{ old('status') == App\Models\JobFairStallOption::STATUS_INACTIVE ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @include('alerts.feedback', ['field' => 'status'])
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

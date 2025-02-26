@extends('institute.layouts.master')
@section('title', 'Edit Stall Option')
@section('content')
    <!-- Stall Option Edit -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Edit Stall Option') }}</h2>
                <a href="{{ route('institute.setup.jfs.list') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>

            <form action="{{ route('institute.setup.jfs.update', $stallOption->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="stall_size" class="form-label">Stall Size</label>
                    <input type="text" class="form-control" value="{{ old('stall_size', $stallOption->stall_size) }}" 
                        placeholder="Enter stall size" id="stall_size" name="stall_size">
                    @include('alerts.feedback', ['field' => 'stall_size'])
                </div>

                <div class="mb-3">
                    <label for="maximum_representative" class="form-label">Maximum Representatives</label>
                    <input type="number" class="form-control" value="{{ old('maximum_representative', $stallOption->maximum_representative) }}" 
                        placeholder="Enter maximum representatives" id="maximum_representative" name="maximum_representative" min="1">
                    @include('alerts.feedback', ['field' => 'maximum_representative'])
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" 
                        placeholder="Enter description">{{ old('description', $stallOption->description) }}</textarea>
                    @include('alerts.feedback', ['field' => 'description'])
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ old('status', $stallOption->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $stallOption->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @include('alerts.feedback', ['field' => 'status'])
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

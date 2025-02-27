@extends('institute.layouts.master')
@section('title', 'Edit Job Fair')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ __('Edit Job Fair') }}</h4>
                <a href="{{ route('institute.jf.index') }}" class="btn btn-sm btn-primary">
                    {{ __('Back') }}
                </a>
            </div>
            <form action="{{ route('institute.jf.update', $jobFair) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Basic Information') }}</h5>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $jobFair->title) }}" required>
                                        @include('alerts.feedback', ['field' => 'title'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $jobFair->description) }}</textarea>
                                        @include('alerts.feedback', ['field' => 'description'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $jobFair->start_date->format('Y-m-d\TH:i')) }}" required>
                                        @include('alerts.feedback', ['field' => 'start_date'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('End Date') }} <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $jobFair->end_date->format('Y-m-d\TH:i')) }}" required>
                                        @include('alerts.feedback', ['field' => 'end_date'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Maximum Companies') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="maximum_companies" class="form-control @error('maximum_companies') is-invalid @enderror" value="{{ old('maximum_companies', $jobFair->maximum_companies) }}" min="1" required>
                                        @include('alerts.feedback', ['field' => 'maximum_companies'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 card-title">{{ __('Stall Options') }}</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="addStallOption">
                                        {{ __('Add Option') }}
                                    </button>
                                </div>
                                <hr>
                                <div id="stallOptionsContainer" class="row g-3">
                                    @foreach($jobFair->stallOptions as $option)
                                        <div class="col-12 stall-option">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mb-3 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-danger remove-stall-option">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="row g-3">
                                                        <input type="hidden" name="stall_options[{{ $loop->index }}][id]" value="{{ $option->id }}">
                                                        <div class="col-12">
                                                            <label class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="stall_options[{{ $loop->index }}][title]" class="form-control" value="{{ $option->title }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">{{ __('Stall Size') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="stall_options[{{ $loop->index }}][stall_size]" class="form-control" value="{{ $option->stall_size }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">{{ __('Maximum Representatives') }} <span class="text-danger">*</span></label>
                                                            <input type="number" name="stall_options[{{ $loop->index }}][maximum_representative]" class="form-control" value="{{ $option->maximum_representative }}" min="1" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                                            <textarea name="stall_options[{{ $loop->index }}][description]" class="form-control" rows="2" required>{{ $option->description }}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
                                                            <input type="number" name="stall_options[{{ $loop->index }}][price]" class="form-control" value="{{ $option->price }}" min="0" step="0.01" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Update Job Fair') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Load active stall options
        $.get("{{ route('institute.jf.getActiveOptions') }}", function(data) {
            window.stallOptions = data;
        });

        // Add stall option
        $('#addStallOption').click(function() {
            const index = $('.stall-option').length;
            const template = `
                <div class="col-12 stall-option">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger remove-stall-option">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="stall_options[${index}][title]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Stall Size') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="stall_options[${index}][stall_size]" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('Maximum Representatives') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="stall_options[${index}][maximum_representative]" class="form-control" min="1" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                    <textarea name="stall_options[${index}][description]" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="stall_options[${index}][price]" class="form-control" min="0" step="0.01" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#stallOptionsContainer').append(template);
        });

        // Remove stall option
        $(document).on('click', '.remove-stall-option', function() {
            $(this).closest('.stall-option').remove();
        });
    });
</script>
@endpush

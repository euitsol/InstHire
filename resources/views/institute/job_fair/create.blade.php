@extends('institute.layouts.master')
@section('title', 'Create Job Fair')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ __('Create Job Fair') }}</h4>
                <a href="{{ route('institute.jf.index') }}" class="btn btn-sm btn-primary">
                    {{ __('Back') }}
                </a>
            </div>
            <form action="{{ route('institute.jf.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Basic Information') }}</h5>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                        @include('alerts.feedback', ['field' => 'title'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Description') }}</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                        @include('alerts.feedback', ['field' => 'description'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Location') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                                        @include('alerts.feedback', ['field' => 'location'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
                                        @include('alerts.feedback', ['field' => 'start_date'])
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('End Date') }} <span class="text-danger">*</span></label>
                                        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}" required>
                                        @include('alerts.feedback', ['field' => 'end_date'])
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">{{ __('Maximum Companies') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="maximum_companies" class="form-control @error('maximum_companies') is-invalid @enderror" value="{{ old('maximum_companies') }}" min="1" required>
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
                                    <!-- Stall options will be added here dynamically -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Create Job Fair') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Unbind any existing click handlers to prevent double binding
        $('#addStallOption').off('click');

        // Add stall option button click handler
        $('#addStallOption').on('click', function() {
            console.log('clicked');
            $.get("{{ route('institute.jf.getActiveOptions') }}", function(options) {
                if (options.length > 0) {
                    addStallOption(options);
                } else {
                    alert("No active stall options available");
                }
            });
        });

        // Function to add stall option select
        function addStallOption(options) {
            const optionsHtml = options.map(option => `
                <option value="${option.id}">
                     ${option.stall_size} (Max ${option.maximum_representative} representatives)
                </option>
            `).join('');

            const html = `
                <div class="col-12 stall-option-row">
                    <div class="gap-2 d-flex">
                        <select name="stall_options[]" class="form-select @error('stall_options.*') is-invalid @enderror" required>
                            ${optionsHtml}
                        </select>
                        <button type="button" class="btn btn-sm btn-danger remove-stall-option">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted stall-description"></small>
                    </div>
                    @include('alerts.feedback', ['field' => 'stall_options.*'])
                </div>
            `;

            $('#stallOptionsContainer').append(html);

            // Add change event to show description
            $('#stallOptionsContainer select').last().change(function() {
                const selectedOption = options.find(opt => opt.id == $(this).val());
                if (selectedOption) {
                    $(this).closest('.stall-option-row').find('.stall-description').text(selectedOption.description);
                }
            }).trigger('change');
        }

        // Remove stall option
        $(document).off('click', '.remove-stall-option');
        $(document).on('click', '.remove-stall-option', function() {
            $(this).closest('.stall-option-row').remove();
        });

        // Initialize with old values if they exist
        @if(old('stall_options'))
            $.get("{{ route('institute.jf.getActiveOptions') }}", function(options) {
                if (options.length > 0) {
                    const oldValues = @json(old('stall_options'));
                    oldValues.forEach(() => {
                        addStallOption(options);
                    });
                    // Set the old values after adding all options
                    $('.stall-option-row select').each(function(index) {
                        $(this).val(oldValues[index]).trigger('change');
                    });
                }
            });
        @endif
    });
</script>
@endpush

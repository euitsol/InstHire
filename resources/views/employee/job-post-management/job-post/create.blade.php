@extends('employee.layouts.master')
@section('title', 'Create Job Post')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="card-title mb-0">{{ __('Create Job Post') }}</h2>
                <a href="{{ route('employee.job-posts.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ __('Back to List') }}
                </a>
            </div>

            <form action="{{ route('employee.job-posts.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">{{ __('Job Title') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="company_name" class="form-label">{{ __('Company Name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                        @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">{{ __('Job Category') }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="job_type" class="form-label">{{ __('Job Type') }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                            <option value="">{{ __('Select Job Type') }}</option>
                            <option value="{{ App\Models\JobPost::FULL_TIME }}" {{ old('job_type') == App\Models\JobPost::FULL_TIME ? 'selected' : '' }}>
                                {{ __('Full Time') }}
                            </option>
                            <option value="{{ App\Models\JobPost::PART_TIME }}" {{ old('job_type') == App\Models\JobPost::PART_TIME ? 'selected' : '' }}>
                                {{ __('Part Time') }}
                            </option>
                            <option value="{{ App\Models\JobPost::WORK_FROM_HOME }}" {{ old('job_type') == App\Models\JobPost::WORK_FROM_HOME ? 'selected' : '' }}>
                                {{ __('Work From Home') }}
                            </option>
                            <option value="{{ App\Models\JobPost::CONTRACTUAL }}" {{ old('job_type') == App\Models\JobPost::CONTRACTUAL ? 'selected' : '' }}>
                                {{ __('Contractual') }}
                            </option>
                            <option value="{{ App\Models\JobPost::INTERN }}" {{ old('job_type') == App\Models\JobPost::INTERN ? 'selected' : '' }}>
                                {{ __('Intern') }}
                            </option>
                        </select>
                        @error('job_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="salary_type" class="form-label">{{ __('Salary Type') }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('salary_type') is-invalid @enderror" id="salary_type" name="salary_type" required>
                            <option value="">{{ __('Select Salary Type') }}</option>
                            <option value="{{ App\Models\JobPost::SALARY_PER_MONTH }}" {{ old('salary_type') == App\Models\JobPost::SALARY_PER_MONTH ? 'selected' : '' }}>
                                {{ __('Per Month') }}
                            </option>
                            <option value="{{ App\Models\JobPost::SALARY_PER_YEAR }}" {{ old('salary_type') == App\Models\JobPost::SALARY_PER_YEAR ? 'selected' : '' }}>
                                {{ __('Per Year') }}
                            </option>
                            <option value="{{ App\Models\JobPost::SALARY_NEGOTIABLE }}" {{ old('salary_type') == App\Models\JobPost::SALARY_NEGOTIABLE ? 'selected' : '' }}>
                                {{ __('Negotiable') }}
                            </option>
                        </select>
                        @error('salary_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="salary" class="form-label">{{ __('Salary') }}</label>
                        <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary') }}" step="0.01">
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="deadline" class="form-label">{{ __('Application Deadline') }} <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="{{ old('deadline') }}" required>
                        @error('deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="vacancy" class="form-label">{{ __('Number of Vacancies') }}</label>
                        <input type="number" class="form-control @error('vacancy') is-invalid @enderror" id="vacancy" name="vacancy" value="{{ old('vacancy') }}" min="1">
                        @error('vacancy')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">{{ __('Contact Email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="application_url" class="form-label">{{ __('Application URL') }}</label>
                        <input type="url" class="form-control @error('application_url') is-invalid @enderror" id="application_url" name="application_url" value="{{ old('application_url') }}">
                        @error('application_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="job_location" class="form-label">{{ __('Job Location') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('job_location') is-invalid @enderror" id="job_location" name="job_location" rows="2" required>{{ old('job_location') }}</textarea>
                        @error('job_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="company_address" class="form-label">{{ __('Company Address') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" rows="2" required>{{ old('company_address') }}</textarea>
                        @error('company_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="job_responsibility" class="form-label">{{ __('Job Responsibilities') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('job_responsibility') is-invalid @enderror" id="job_responsibility" name="job_responsibility" rows="4" required>{{ old('job_responsibility') }}</textarea>
                        @error('job_responsibility')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="educational_requirement" class="form-label">{{ __('Educational Requirements') }}</label>
                        <textarea class="form-control @error('educational_requirement') is-invalid @enderror" id="educational_requirement" name="educational_requirement" rows="4">{{ old('educational_requirement') }}</textarea>
                        @error('educational_requirement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="professional_requirement" class="form-label">{{ __('Professional Requirements') }}</label>
                        <textarea class="form-control @error('professional_requirement') is-invalid @enderror" id="professional_requirement" name="professional_requirement" rows="4">{{ old('professional_requirement') }}</textarea>
                        @error('professional_requirement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="experience_requirement" class="form-label">{{ __('Experience Requirements') }}</label>
                        <textarea class="form-control @error('experience_requirement') is-invalid @enderror" id="experience_requirement" name="experience_requirement" rows="4">{{ old('experience_requirement') }}</textarea>
                        @error('experience_requirement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="additional_requirement" class="form-label">{{ __('Additional Requirements') }}</label>
                        <textarea class="form-control @error('additional_requirement') is-invalid @enderror" id="additional_requirement" name="additional_requirement" rows="4">{{ old('additional_requirement') }}</textarea>
                        @error('additional_requirement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="other_benefits" class="form-label">{{ __('Other Benefits') }}</label>
                        <textarea class="form-control @error('other_benefits') is-invalid @enderror" id="other_benefits" name="other_benefits" rows="4">{{ old('other_benefits') }}</textarea>
                        @error('other_benefits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="special_instractions" class="form-label">{{ __('Special Instructions') }}</label>
                        <textarea class="form-control @error('special_instractions') is-invalid @enderror" id="special_instractions" name="special_instractions" rows="4">{{ old('special_instractions') }}</textarea>
                        @error('special_instractions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> {{ __('Create Job Post') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('institute.layouts.master')
@section('title', 'Job Post Details')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">{{ __('Job Post Details') }}</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('institute.job-post.index') }}" class="btn btn-sm btn-primary">
                        {{ __('Back') }}
                    </a>
                    <a href="{{ route('institute.job-post.edit', $jobPost->id) }}" class="btn btn-sm btn-warning">
                        {{ __('Edit') }}
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center mb-4">
                        <h3>{{ $jobPost->title }}</h3>
                        <p class="text-muted mb-3">{{ $jobPost->company_name }}</p>
                        <div class="d-flex justify-content-center gap-2">
                            <span class="badge bg-info">{{ $jobPost->job_type_label }}</span>
                            <span class="{{ $jobPost->status_badge_color }}">
                                {{ $jobPost->job_status_label }}
                            </span>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Basic Information') }}</h5>
                                    <hr>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Category') }}</label>
                                            <p>{{ optional($jobPost->category)->title }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Visibility') }}</label>
                                            <p><span class="badge bg-secondary">{{ $jobPost->visibility_label }}</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Type') }}</label>
                                            <p><span class="badge bg-info">{{ $jobPost->type_label }}</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Posted By') }}</label>
                                            <p>{{ optional($jobPost->employee)->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Email') }}</label>
                                            <p>{{ $jobPost->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Application URL') }}</label>
                                            <p>
                                                @if($jobPost->application_url)
                                                    <a href="{{ $jobPost->application_url }}" target="_blank">{{ __('Apply Here') }}</a>
                                                @else
                                                    {{ __('N/A') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Job Details') }}</h5>
                                    <hr>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Salary') }}</label>
                                            <p>{{ number_format($jobPost->salary) }} ({{ $jobPost->salary_type_label }})</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Deadline') }}</label>
                                            <p>{{ date('d M, Y', strtotime($jobPost->deadline)) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Vacancy') }}</label>
                                            <p>{{ $jobPost->vacancy }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Job Location') }}</label>
                                            <p>{{ $jobPost->job_location }}</p>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">{{ __('Company Address') }}</label>
                                            <p>{{ $jobPost->company_address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Requirements & Benefits') }}</h5>
                                    <hr>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Job Responsibility') }}</label>
                                            <div class="p-3 text-justify rounded">
                                                {!! nl2br(e($jobPost->job_responsibility)) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ __('Educational Requirements') }}</label>
                                            <div class="p-3 text-justify rounded">
                                                {!! nl2br(e($jobPost->educational_requirement)) !!}
                                            </div>
                                        </div>
                                        @if($jobPost->professional_requirement)
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">{{ __('Professional Requirements') }}</label>
                                                <div class="p-3 text-jus rounded">
                                                    {!! nl2br(e($jobPost->professional_requirement)) !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if($jobPost->experience_requirement)
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">{{ __('Experience Requirements') }}</label>
                                                <div class="p-3 text-jus rounded">
                                                    {!! nl2br(e($jobPost->experience_requirement)) !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if($jobPost->age_requirement)
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">{{ __('Age Requirements') }}</label>
                                                <div class="p-3 text-jus rounded">
                                                    {!! nl2br(e($jobPost->age_requirement)) !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if($jobPost->additional_requirement)
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">{{ __('Additional Requirements') }}</label>
                                                <div class="p-3 text-jus rounded">
                                                    {!! nl2br(e($jobPost->additional_requirement)) !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if($jobPost->other_benefits)
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">{{ __('Other Benefits') }}</label>
                                                <div class="p-3 text-jus rounded">
                                                    {!! nl2br(e($jobPost->other_benefits)) !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if($jobPost->special_instractions)
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">{{ __('Special Instructions') }}</label>
                                                <div class="p-3 text-jus rounded">
                                                    {!! nl2br(e($jobPost->special_instractions)) !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

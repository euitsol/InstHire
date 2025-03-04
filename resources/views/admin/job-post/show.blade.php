@extends('admin.layouts.master', ['page_slug' => 'job-post'])
@section('title', 'Job Post Details')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">{{ __('Job Post Details') }}</h4>
                        <a href="{{ route('jm.job-post.index') }}" class="btn btn-primary">
                            {{ __('Back') }}
                        </a>
                    </div>

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Basic Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="35%">{{ __('Job Title') }}</th>
                                            <td>{{ $jobPost->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Company Name') }}</th>
                                            <td>{{ $jobPost->company_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Category') }}</th>
                                            <td>{{ $jobPost->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Job Type') }}</th>
                                            <td><span
                                                    class="{{ $jobPost->job_type_color }}">{{ $jobPost->job_type_label }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Visibility') }}</th>{{ $jobPost->visibility_label }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Status') }}</th>
                                            <td>
                                                <span class="{{ $jobPost->status_badge_color }}">
                                                    {{ $jobPost->status_label }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Salary & Deadline -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Salary & Deadline Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="35%">{{ __('Salary') }}</th>
                                            <td>
                                                {{ $jobPost->salary . ' ' . $jobPost->salary_type_label }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Vacancy') }}</th>
                                            <td>{{ $jobPost->vacancy }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Deadline') }}</th>
                                            <td>{{ date('d M, Y', strtotime($jobPost->deadline)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Application URL') }}</th>
                                            <td>
                                                @if ($jobPost->application_url)
                                                    <a href="{{ $jobPost->application_url }}"
                                                        target="_blank">{{ $jobPost->application_url }}</a>
                                                @else
                                                    <span class="text-muted">Not Available</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Contact Email') }}</th>
                                            <td>{{ $jobPost->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Job Requirements -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Job Requirements') }}</h5>
                                </div>
                                <div class="card-body">
                                    @if ($jobPost->educational_requirement)
                                        <h6 class="fw-bold">{{ __('Educational Requirements') }}</h6>
                                        <p class="mb-3">{!! $jobPost->educational_requirement !!}</p>
                                    @endif

                                    @if ($jobPost->professional_requirement)
                                        <h6 class="fw-bold">{{ __('Professional Requirements') }}</h6>
                                        <p class="mb-3">{!! $jobPost->professional_requirement !!}</p>
                                    @endif

                                    @if ($jobPost->experience_requirement)
                                        <h6 class="fw-bold">{{ __('Experience Requirements') }}</h6>
                                        <p class="mb-3">{!! $jobPost->experience_requirement !!}</p>
                                    @endif

                                    @if ($jobPost->age_requirement)
                                        <h6 class="fw-bold">{{ __('Age Requirements') }}</h6>
                                        <p class="mb-3">{!! $jobPost->age_requirement !!}</p>
                                    @endif

                                    @if ($jobPost->additional_requirement)
                                        <h6 class="fw-bold">{{ __('Additional Requirements') }}</h6>
                                        <p class="mb-0">{!! $jobPost->additional_requirement !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Job Details -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Job Details') }}</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ __('Job Responsibilities') }}</h6>
                                    <p class="mb-4">{!! $jobPost->job_responsibility !!}</p>

                                    <h6 class="fw-bold">{{ __('Job Location') }}</h6>
                                    <p class="mb-4">{!! $jobPost->job_location !!}</p>

                                    @if ($jobPost->other_benefits)
                                        <h6 class="fw-bold">{{ __('Other Benefits') }}</h6>
                                        <p class="mb-4">{!! $jobPost->other_benefits !!}</p>
                                    @endif

                                    @if ($jobPost->special_instractions)
                                        <h6 class="fw-bold">{{ __('Special Instructions') }}</h6>
                                        <p class="mb-0">{!! $jobPost->special_instractions !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Company Information -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('Company Information') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">{{ __('Company Address') }}</h6>
                                            <p class="mb-0">{!! $jobPost->company_address !!}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="35%">{{ __('Posted By') }}</th>
                                                    <td>
                                                        {{ optional($jobPost->creater)->name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Created At') }}</th>
                                                    <td>{{ $jobPost->created_at->format('d M, Y h:i A') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Last Updated') }}</th>
                                                    <td>{{ $jobPost->updated_at->format('d M, Y h:i A') }}</td>
                                                </tr>
                                            </table>
                                        </div>
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

@extends('employee.layouts.master')
@section('title', 'Job Post Details')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="card-title mb-0">{{ __('Job Post Details') }}</h2>
                <div>
                    <a href="{{ route('employee.job-posts.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> {{ __('Back to List') }}
                    </a>
                    @if($jobPost->status == App\Models\JobPost::STATUS_PENDING)
                        <a href="{{ route('employee.job-posts.edit', $jobPost) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> {{ __('Edit') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">{{ __('Job Title') }}</th>
                            <td>{{ $jobPost->title }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Company Name') }}</th>
                            <td>{{ $jobPost->company_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <td>{{ optional($jobPost->category)->title }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Job Type') }}</th>
                            <td><span class="badge bg-info">{{ $jobPost->job_type_label }}</span></td>
                        </tr>
                        <tr>
                            <th>{{ __('Salary') }}</th>
                            <td>
                                @if($jobPost->salary_type == App\Models\JobPost::SALARY_NEGOTIABLE)
                                    {{ __('Negotiable') }}
                                @else
                                    {{ number_format($jobPost->salary, 2) }} ({{ $jobPost->salary_type_label }})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Deadline') }}</th>
                            <td>{{ $jobPost->deadline->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Vacancy') }}</th>
                            <td>{{ $jobPost->vacancy }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Contact Email') }}</th>
                            <td>{{ $jobPost->email }}</td>
                        </tr>
                        @if($jobPost->application_url)
                            <tr>
                                <th>{{ __('Application URL') }}</th>
                                <td><a href="{{ $jobPost->application_url }}" target="_blank">{{ $jobPost->application_url }}</a></td>
                            </tr>
                        @endif
                        <tr>
                            <th>{{ __('Job Location') }}</th>
                            <td>{{ $jobPost->job_location }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Company Address') }}</th>
                            <td>{{ $jobPost->company_address }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Job Responsibilities') }}</th>
                            <td>{!! nl2br(e($jobPost->job_responsibility)) !!}</td>
                        </tr>
                        @if($jobPost->educational_requirement)
                            <tr>
                                <th>{{ __('Educational Requirements') }}</th>
                                <td>{!! nl2br(e($jobPost->educational_requirement)) !!}</td>
                            </tr>
                        @endif
                        @if($jobPost->professional_requirement)
                            <tr>
                                <th>{{ __('Professional Requirements') }}</th>
                                <td>{!! nl2br(e($jobPost->professional_requirement)) !!}</td>
                            </tr>
                        @endif
                        @if($jobPost->experience_requirement)
                            <tr>
                                <th>{{ __('Experience Requirements') }}</th>
                                <td>{!! nl2br(e($jobPost->experience_requirement)) !!}</td>
                            </tr>
                        @endif
                        @if($jobPost->additional_requirement)
                            <tr>
                                <th>{{ __('Additional Requirements') }}</th>
                                <td>{!! nl2br(e($jobPost->additional_requirement)) !!}</td>
                            </tr>
                        @endif
                        @if($jobPost->other_benefits)
                            <tr>
                                <th>{{ __('Other Benefits') }}</th>
                                <td>{!! nl2br(e($jobPost->other_benefits)) !!}</td>
                            </tr>
                        @endif
                        @if($jobPost->special_instractions)
                            <tr>
                                <th>{{ __('Special Instructions') }}</th>
                                <td>{!! nl2br(e($jobPost->special_instractions)) !!}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <td><span class="{{ $jobPost->status_badge_color }}">{{ $jobPost->job_status_label }}</span></td>
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
@endsection

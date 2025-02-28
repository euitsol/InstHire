@extends('student.layouts.master')

@section('title', 'Job Application Details')

@section('content')
<div class="px-4 container-fluid">
    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">Job Application Details</h1>
            <p class="text-muted">View details of your job application</p>
        </div>
        <div>
            <a href="{{ route('student.job.index') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Job Details -->
            <div class="mb-4 rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="p-3 rounded company-logo bg-light me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <span class="mb-0 h4 text-primary fw-bold">{{ substr($application->jobPost->company_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="mb-1 card-title">{{ $application->jobPost->title }}</h4>
                            <p class="mb-0 text-muted">{{ $application->jobPost->company_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 rounded-3 bg-light">
                                <h5 class="mb-3 h6 text-uppercase text-muted">Job Details</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-geo-alt text-primary me-2"></i>
                                        <span>{{ $application->jobPost->job_location }}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-briefcase text-primary me-2"></i>
                                        <span>{{ $application->jobPost->job_type_label }}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-currency-dollar text-primary me-2"></i>
                                        <span>
                                            {{ $application->jobPost->salary != '' ? $application->jobPost->salary : 'Negotiable' }}
                                            {{ $application->jobPost->salary_type != \App\Models\JobPost::SALARY_NEGOTIABLE ? '(' . $application->jobPost->salary_type_label . ')' : '' }}
                                        </span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-calendar-event text-primary me-2"></i>
                                        <span>Posted {{ $application->jobPost->created_at->diffForHumans() }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light">
                                <h5 class="mb-3 h6 text-uppercase text-muted">Application Status</h5>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">Status:</div>
                                        <span class="badge bg-{{ $application->status_color }}">{{ $application->status_label }}</span>
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-calendar-check text-primary me-2"></i>
                                        <span>Applied on: {{ $application->created_at->format('M d, Y') }}</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                        <span>CV: {{ $application->cv ? $application->cv->title : 'Not specified' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @if($application->cover_letter)
                    <div class="mb-4">
                        <h5 class="mb-3 h6 text-uppercase text-muted">Cover Letter</h5>
                        <div class="p-3 rounded-3 bg-light">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Job Description -->
                    <div class="mb-4">
                        <h5 class="mb-3 h6 text-uppercase text-muted">Job Description</h5>
                        
                        @if($application->jobPost->job_responsibility)
                        <div class="mb-4">
                            <h6 class="mb-2 fw-bold">Job Responsibilities</h6>
                            <div class="text-muted">
                                {!! nl2br(e($application->jobPost->job_responsibility)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($application->jobPost->educational_requirement)
                        <div class="mb-4">
                            <h6 class="mb-2 fw-bold">Educational Requirements</h6>
                            <div class="text-muted">
                                {!! nl2br(e($application->jobPost->educational_requirement)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($application->jobPost->experience_requirement)
                        <div class="mb-4">
                            <h6 class="mb-2 fw-bold">Experience Requirements</h6>
                            <div class="text-muted">
                                {!! nl2br(e($application->jobPost->experience_requirement)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($application->jobPost->additional_requirement)
                        <div class="mb-4">
                            <h6 class="mb-2 fw-bold">Additional Requirements</h6>
                            <div class="text-muted">
                                {!! nl2br(e($application->jobPost->additional_requirement)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($application->jobPost->other_benefits)
                        <div class="mb-4">
                            <h6 class="mb-2 fw-bold">Other Benefits</h6>
                            <div class="text-muted">
                                {!! nl2br(e($application->jobPost->other_benefits)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Application Timeline -->
            <div class="mb-4 rounded-xl shadow-sm card sticky-lg-top" style="top: 100px; z-index: 999;">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Application Timeline</h4>
                </div>
                <div class="card-body">
                    <div class="application-timeline">
                        @php
                            $timelineItems = [
                                [
                                    'status' => \App\Models\JobApplication::STATUS_APPLIED,
                                    'label' => 'Applied',
                                    'icon' => 'bi-send',
                                    'date' => $application->created_at->format('M d, Y'),
                                    'active' => true,
                                ],
                                [
                                    'status' => \App\Models\JobApplication::STATUS_SHORTLISTED,
                                    'label' => 'Shortlisted',
                                    'icon' => 'bi-list-check',
                                    'date' => null,
                                    'active' => $application->status >= \App\Models\JobApplication::STATUS_SHORTLISTED,
                                ],
                                [
                                    'status' => \App\Models\JobApplication::STATUS_CALLED_FOR_INTERVIEW,
                                    'label' => 'Interview Call',
                                    'icon' => 'bi-telephone',
                                    'date' => null,
                                    'active' => $application->status >= \App\Models\JobApplication::STATUS_CALLED_FOR_INTERVIEW,
                                ],
                                [
                                    'status' => \App\Models\JobApplication::STATUS_INTERVIEWED,
                                    'label' => 'Interviewed',
                                    'icon' => 'bi-people',
                                    'date' => null,
                                    'active' => $application->status >= \App\Models\JobApplication::STATUS_INTERVIEWED,
                                ],
                                [
                                    'status' => \App\Models\JobApplication::STATUS_ACCEPTED,
                                    'label' => 'Accepted',
                                    'icon' => 'bi-check-circle',
                                    'date' => null,
                                    'active' => $application->status == \App\Models\JobApplication::STATUS_ACCEPTED,
                                ],
                            ];
                            
                            // If rejected, add a special item
                            if ($application->status == \App\Models\JobApplication::STATUS_REJECTED) {
                                $timelineItems[] = [
                                    'status' => \App\Models\JobApplication::STATUS_REJECTED,
                                    'label' => 'Rejected',
                                    'icon' => 'bi-x-circle',
                                    'date' => null,
                                    'active' => true,
                                    'rejected' => true,
                                ];
                            }
                        @endphp
                        
                        <ul class="list-unstyled timeline-steps">
                            @foreach($timelineItems as $item)
                                @if(!isset($item['rejected']) || $application->status == \App\Models\JobApplication::STATUS_REJECTED)
                                <li class="timeline-step {{ $item['active'] ? 'active' : '' }} {{ isset($item['rejected']) && $item['rejected'] ? 'rejected' : '' }}">
                                    <div class="timeline-icon">
                                        <i class="bi {{ $item['icon'] }}"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1 fw-bold">{{ $item['label'] }}</h6>
                                        <p class="mb-0 small text-muted">
                                            {{ $item['date'] ?? ($item['active'] ? 'Completed' : 'Pending') }}
                                        </p>
                                    </div>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Company Info -->
            @if($application->jobPost->company_address)
            <div class="rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom">
                    <h4 class="mb-0 card-title">Company Information</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 d-flex align-items-center">
                        <div class="p-3 rounded company-logo bg-light me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <span class="mb-0 h4 text-primary fw-bold">{{ substr($application->jobPost->company_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h5 class="mb-1">{{ $application->jobPost->company_name }}</h5>
                        </div>
                    </div>
                    
                    <div class="mb-0">
                        <h6 class="mb-2 fw-bold">Address</h6>
                        <p class="mb-0 text-muted">
                            {{ $application->jobPost->company_address }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .company-logo {
        min-width: 50px;
    }
    
    .timeline-steps {
        position: relative;
    }
    
    .timeline-step {
        position: relative;
        padding-left: 45px;
        margin-bottom: 20px;
    }
    
    .timeline-step:last-child {
        margin-bottom: 0;
    }
    
    .timeline-step:before {
        content: '';
        position: absolute;
        left: 15px;
        top: 25px;
        bottom: -20px;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-step:last-child:before {
        display: none;
    }
    
    .timeline-icon {
        position: absolute;
        left: 0;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }
    
    .timeline-step.active .timeline-icon {
        background-color: #4e73df;
        color: white;
    }
    
    .timeline-step.rejected .timeline-icon {
        background-color: #e74a3b;
        color: white;
    }
    
    .timeline-content {
        padding: 3px 0;
    }
</style>
@endpush

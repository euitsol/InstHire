@extends('employee.layouts.master')

@section('title', 'Application Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Details</h5>
                    <a href="{{ route('employee.applications.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Back to Applications
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Job Information</h6>
                            <div class="mb-4">
                                <p class="mb-1"><strong>Title:</strong> {{ $application->job->title }}</p>
                                <p class="mb-1"><strong>Institute:</strong> {{ $application->job->institute->name }}</p>
                                <p class="mb-1"><strong>Location:</strong> {{ $application->job->location }}</p>
                                <p class="mb-0"><strong>Salary:</strong> {{ $application->job->salary }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Application Status</h6>
                            <div class="mb-4">
                                <p class="mb-1">
                                    <strong>Status:</strong>
                                    <span class="badge bg-{{ $application->status_color }}">
                                        {{ $application->status }}
                                    </span>
                                </p>
                                <p class="mb-1"><strong>Applied Date:</strong> {{ $application->created_at->format('M d, Y') }}</p>
                                @if($application->updated_at->ne($application->created_at))
                                    <p class="mb-0"><strong>Last Updated:</strong> {{ $application->updated_at->format('M d, Y') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-muted">Job Description</h6>
                            <div class="mb-4">
                                {!! $application->job->description !!}
                            </div>
                        </div>
                    </div>

                    @if($application->cover_letter)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-muted">Your Cover Letter</h6>
                                <div class="mb-4">
                                    {!! nl2br(e($application->cover_letter)) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($application->resume)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-muted">Your Resume</h6>
                                <div class="mb-4">
                                    <a href="{{ asset('storage/' . $application->resume) }}" 
                                       class="btn btn-primary" 
                                       target="_blank">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        View Resume
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

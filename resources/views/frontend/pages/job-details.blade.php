@extends('frontend.layouts.app')

@section('content')

    <!-- Job Details Content -->
    <section class="py-5 mt-5 job-details-content">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8" data-aos="fade-up">
                    <!-- Job Header -->
                    <div class="mb-4 border-0 shadow-sm card">
                        <div class="p-4 card-body">
                            <div class="mb-3 d-flex align-items-center">
                                <div class="p-3 rounded company-logo bg-light me-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <span class="mb-0 h3 text-primary fw-bold">{{ substr($job->company_name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h1 class="mb-2 h3">{{ $job->title }}</h1>
                                    <h2 class="mb-0 h5 text-muted">{{ $job->company_name }}</h2>
                                </div>
                            </div>

                            <div class="flex-wrap gap-3 mb-3 d-flex">
                                <div class="job-meta">
                                    <i class="bi bi-geo-alt text-primary me-1"></i>
                                    <span>{{ $job->job_location }}</span>
                                </div>
                                <div class="job-meta">
                                    <i class="bi bi-briefcase text-primary me-1"></i>
                                    <span>{{ $job->job_type_label }}</span>
                                </div>
                                <div class="job-meta">
                                    <i class="bi bi-currency-dollar text-primary me-1"></i>
                                    <span>
                                        {{ $job->salary != '' ? $job->salary : 'Negotiable' }}
                                        {{ $job->salary_type != \App\Models\JobPost::SALARY_NEGOTIABLE ? '(' . $job->salary_type_label . ')' : '' }}
                                    </span>
                                </div>
                                <div class="job-meta">
                                    <i class="bi bi-calendar-event text-primary me-1"></i>
                                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="flex-wrap gap-2 d-flex">
                                <span class="badge bg-light text-dark">
                                    {{ $job->category ? $job->category->name : 'General' }}
                                </span>
                                @if($job->vacancy)
                                <span class="badge bg-light text-dark">
                                    {{ $job->vacancy }} Openings
                                </span>
                                @endif
                                @if(\Carbon\Carbon::now()->diffInDays($job->created_at) < 3)
                                <span class="badge bg-success">New</span>
                                @endif
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-0">
                                        <i class="bi bi-clock text-muted me-1"></i>
                                        <span class="small">Application Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>
                                    </p>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bi bi-bookmark"></i> Save
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-share"></i> Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="mb-4 border-0 shadow-sm card">
                        <div class="p-4 card-body">
                            <h3 class="mb-4 h5">Job Description</h3>

                            @if($job->job_responsibility)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Job Responsibilities</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->job_responsibility)) !!}
                                </div>
                            </div>
                            @endif

                            @if($job->educational_requirement)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Educational Requirements</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->educational_requirement)) !!}
                                </div>
                            </div>
                            @endif

                            @if($job->experience_requirement)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Experience Requirements</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->experience_requirement)) !!}
                                </div>
                            </div>
                            @endif

                            @if($job->professional_requirement)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Professional Requirements</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->professional_requirement)) !!}
                                </div>
                            </div>
                            @endif

                            @if($job->additional_requirement)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Additional Requirements</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->additional_requirement)) !!}
                                </div>
                            </div>
                            @endif

                            @if($job->other_benefits)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Benefits & Perks</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->other_benefits)) !!}
                                </div>
                            </div>
                            @endif

                            @if($job->special_instractions)
                            <div class="mb-4">
                                <h4 class="h6 fw-bold">Special Instructions</h4>
                                <div class="job-description">
                                    {!! nl2br(e($job->special_instractions)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div class="mb-4 border-0 shadow-sm card">
                        <div class="p-4 card-body">
                            <h3 class="mb-4 h5">Company Information</h3>

                            <div class="mb-3">
                                <h4 class="h6 fw-bold">Company Name</h4>
                                <p>{{ $job->company_name }}</p>
                            </div>

                            @if($job->company_address)
                            <div class="mb-3">
                                <h4 class="h6 fw-bold">Company Address</h4>
                                <p>{{ $job->company_address }}</p>
                            </div>
                            @endif

                            <div class="mb-0">
                                <h4 class="h6 fw-bold">About the Company</h4>
                                <p class="mb-0">
                                    {{ $job->institute ? $job->institute->about : 'Information not available' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Apply Card -->
                    <div class="mb-4 border-0 shadow-sm card sticky-lg-top" style="top: 100px; z-index: 999;" data-aos="fade-up" data-aos-delay="100">
                        <div class="p-4 card-body">
                            <h3 class="mb-4 h5">Apply for this Position</h3>


                                @if($job->type == \App\Models\JobPost::TYPE_EXTERNAL && $job->application_url)
                                <a href="{{ $job->application_url }}" target="_blank" class="mb-3 btn btn-primary w-100">
                                    <i class="bi bi-box-arrow-up-right me-2"></i> Apply on Company Website
                                </a>
                                @endif
                                @if($job->type == \App\Models\JobPost::TYPE_SELF)
                                    @if(!$hasApplied)
                                        <button href="javascript:void(0);" type="button" class="mb-3 btn btn-primary w-100" id="applyJobBtn">
                                            <i class="bi bi-box-arrow-up-right me-2"></i> Apply for This Position
                                        </button>
                                    @else
                                        <button href="javascript:void(0);" class="mb-3 btn btn-danger w-100">
                                            <i class="bi bi-check me-2"></i> Already Applied for this Position
                                        </button>
                                    @endif
                                @endif

                            {{-- @if($job->email)
                            <a href="mailto:{{ $job->email }}?subject=Application for {{ $job->title }}" class="mb-3 btn btn-outline-primary w-100">
                                <i class="bi bi-envelope me-2"></i> Apply via Email
                            </a>
                            @endif --}}

                            <div class="mt-3 text-center">
                                <p class="mb-0 text-muted small">Application Deadline</p>
                                <p class="fw-bold">{{ \Carbon\Carbon::parse($job->deadline)->format('F d, Y') }}</p>

                                @if(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($job->deadline)))
                                <div class="mt-3 mb-0 alert alert-warning">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Application deadline has passed
                                </div>
                                @else
                                <div class="mt-3 mb-0 alert alert-info">
                                    <i class="bi bi-clock me-2"></i>
                                    {{ round(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($job->deadline))) }} days remaining
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Related Jobs -->
                    <div class="border-0 shadow-sm card" data-aos="fade-up" data-aos-delay="200">
                        <div class="p-4 card-body">
                            <h3 class="mb-4 h5">Similar Jobs</h3>

                            @if($relatedJobs->count() > 0)
                                @foreach($relatedJobs as $relatedJob)
                                <div class="related-job-item {{ !$loop->last ? 'mb-4 pb-4 border-bottom' : '' }}">
                                    <h4 class="mb-1 h6">
                                        <a href="{{ route('frontend.jobs.show', $relatedJob->id) }}" class="text-decoration-none">
                                            {{ $relatedJob->title }}
                                        </a>
                                    </h4>
                                    <p class="mb-2 text-muted small">{{ $relatedJob->company_name }}</p>
                                    <div class="flex-wrap gap-2 mb-2 d-flex">
                                        <span class="badge bg-light text-dark">{{ $relatedJob->job_type_label }}</span>
                                        <span class="badge bg-light text-dark">{{ $relatedJob->job_location }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted small">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $relatedJob->created_at->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('frontend.jobs.show', $relatedJob->id) }}" class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="py-4 text-center">
                                    <p class="mb-0 text-muted">No similar jobs found</p>
                                </div>
                            @endif

                            <div class="mt-4 text-center">
                                <a href="{{ route('frontend.jobs') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-search me-2"></i> Browse All Jobs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="border-0 shadow-sm card" data-aos="fade-up">
                        <div class="p-5 text-center card-body">
                            <h3 class="mb-4">Didn't find what you're looking for?</h3>
                            <p class="mb-4">Browse more job opportunities or create a job alert to get notified when new positions are posted</p>
                            <div class="gap-3 d-flex flex-column flex-md-row justify-content-center">
                                <a href="{{ route('frontend.jobs') }}" class="btn btn-primary">
                                    <i class="bi bi-search me-2"></i> Browse All Jobs
                                </a>
                                <button class="btn btn-outline-primary">
                                    <i class="bi bi-bell me-2"></i> Create Job Alert
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.pages.includes.apply-modal')
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/job-details.css') }}">
@endpush

@push('scripts')
<script>
    // Define variables needed for the external JS file
    const jobDetailsData = {
        studentCvRoute: "{{ route('student.cv.get') }}"
    };
</script>
<script src="{{ asset('frontend/js/job-details.js') }}"></script>
<script>
    // Handle user-specific AJAX for previous CVs
    @auth('student')
    $.ajax({
        url: "{{ route('student.cv.get') }}",
        type: 'GET',
        success: function(response) {
            const select = $('#previousCvs');
            select.empty();
            select.append('<option value="" selected>Choose a previously uploaded CV</option>');

            response.forEach(cv => {
                select.append(`<option value="${cv.id}">${cv.title} (Uploaded: ${new Date(cv.created_at).toLocaleDateString()})</option>`);
            });
        },
        error: function(xhr) {
            console.error('Error loading CVs:', xhr);
            toastr.error('Failed to load your previous CVs');
        }
    });
    @endauth
</script>
@endpush

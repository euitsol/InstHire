@extends('frontend.layouts.app')

@section('content')
    <!-- Jobs Hero Section -->
    <section class="jobs-hero-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <h1 class="mb-4 fw-bold">Explore Job Opportunities</h1>
                    <p class="mb-4 lead">Find your perfect career match from thousands of verified job listings</p>
                    
                    <!-- Job Search Form -->
                    <div class="p-4 bg-white rounded shadow search-box">
                        <form action="{{ route('frontend.jobs') }}" method="GET" class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control border-start-0" 
                                        placeholder="Job title or keyword" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <input type="text" name="location" class="form-control border-start-0" 
                                        placeholder="Location" value="{{ request('location') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search me-2"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jobs Listing Section -->
    <section class="py-5 jobs-listing">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card shadow-sm border-0 sticky-lg-top" style="top: 100px; z-index: 999;">
                        <div class="card-body">
                            <h5 class="mb-4 fw-bold">Filter Jobs</h5>
                            <form action="{{ route('frontend.jobs') }}" method="GET" id="filter-form">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="location" value="{{ request('location') }}">
                                
                                <!-- Categories Filter -->
                                <div class="mb-4">
                                    <h6 class="mb-3 fw-semibold">Job Category</h6>
                                    <select class="form-select" name="category" id="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Job Type Filter -->
                                <div class="mb-4">
                                    <h6 class="mb-3 fw-semibold">Job Type</h6>
                                    <select class="form-select" name="job_type" id="job_type">
                                        <option value="">All Types</option>
                                        @foreach($jobTypes as $key => $type)
                                            <option value="{{ $key }}" {{ request('job_type') == $key ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-funnel"></i> Apply Filters
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Jobs Grid -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                        <h4 class="mb-3 mb-md-0">Found <span class="text-primary">{{ $jobs->total() }}</span> Jobs</h4>
                        <div class="d-flex align-items-center">
                            <span class="me-2 text-secondary">Sort by:</span>
                            <select class="form-select form-select-sm" style="width: 150px;">
                                <option selected>Most Recent</option>
                                <option>Relevance</option>
                            </select>
                        </div>
                    </div>
                    
                    @if($jobs->count() > 0)
                        <div class="row g-4">
                            @foreach($jobs as $job)
                            <div class="col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="card job-card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="company-logo bg-light rounded p-2">
                                                <i class="bi bi-building text-primary" style="font-size: 2rem;"></i>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <span class="badge bg-light text-dark mb-2">{{ $job->job_type_label }}</span>
                                                <span class="text-muted small">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $job->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                        <h5 class="card-title">
                                            <a href="{{ route('frontend.jobs.show', $job->id) }}" class="text-decoration-none text-dark">
                                                {{ $job->title }}
                                            </a>
                                        </h5>
                                        <h6 class="mb-3 company-name">{{ $job->company_name }}</h6>
                                        <div class="mb-3 job-info">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <i class="bi bi-geo-alt text-muted me-1"></i>
                                                    <span class="small">{{ $job->job_location }}</span>
                                                </div>
                                                <div>
                                                    <i class="bi bi-currency-dollar text-muted me-1"></i>
                                                    <span class="small">
                                                        {{ $job->salary != '' ? $job->salary : 'Negotiable' }} 
                                                        {{ $job->salary_type != \App\Models\JobPost::SALARY_NEGOTIABLE ? '(' . $job->salary_type_label . ')' : '' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <span class="badge bg-light text-dark me-1">
                                                {{ $job->category ? $job->category->name : 'General' }}
                                            </span>
                                            @if($job->vacancy)
                                            <span class="badge bg-light text-dark">
                                                {{ $job->vacancy }} Openings
                                            </span>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('frontend.jobs.show', $job->id) }}" class="btn btn-sm btn-outline-primary">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                    @if(\Carbon\Carbon::now()->diffInDays($job->created_at) < 3)
                                    <div class="position-absolute top-0 start-0 mt-3 ms-3">
                                        <span class="badge bg-success">New</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-5">
                            {{ $jobs->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <img src="{{ asset('frontend/images/no-data.svg') }}" alt="No Jobs Found" class="img-fluid mb-4" style="max-width: 200px;">
                            <h4>No Jobs Found</h4>
                            <p class="text-muted">We couldn't find any jobs matching your criteria.</p>
                            <a href="{{ route('frontend.jobs') }}" class="btn btn-outline-primary mt-3">
                                <i class="bi bi-arrow-left me-2"></i> Clear All Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    <!-- Subscribe Section -->
    <section class="py-5 subscribe-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <h2 class="mb-4 section-title">Get Job Alerts in Your Inbox</h2>
                    <p class="mb-4">Stay updated with the latest job opportunities matching your profile and preferences</p>
                    <form class="subscription-form mx-auto" style="max-width: 500px;">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email address">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .jobs-hero-section {
        padding-top: 120px;
    }
    
    .job-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    
    .job-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        transform: translateY(-5px);
    }
    
    .company-logo {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .company-name {
        color: var(--secondary-color);
        font-weight: 500;
    }
    
    .pagination {
        gap: 5px;
    }
    
    .page-item .page-link {
        border-radius: 8px;
        color: var(--dark-color);
    }
    
    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle filter changes
        $('#category, #job_type').change(function() {
            // Submit form on change if not mobile
            if (window.innerWidth >= 992) {
                $('#filter-form').submit();
            }
        });
        
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
    });
</script>
@endpush

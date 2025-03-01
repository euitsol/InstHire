@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="mb-4 display-4 fw-bold">Find Your Dream Job with InstHire</h1>
                    <p class="mb-4 lead">Connect with top employers, educational institutes, and opportunities that match your skills and aspirations.</p>
                    <div class="p-4 bg-white rounded shadow search-box">
                        <form action="{{ route('frontend.jobs') }}" method="GET" class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="bg-transparent input-group-text border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control border-start-0" placeholder="Job title or keyword">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="bg-transparent input-group-text border-end-0">
                                        <i class="bi bi-grid"></i>
                                    </span>
                                    <select class="form-select border-start-0" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search me-2"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="{{ asset('frontend/assets/img/woman-sitting.svg') }}" alt="Hero Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 stats-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="mb-5 text-center col-lg-8">
                    <h2 class="section-title" data-aos="fade-up">Our Impact in Numbers</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Connecting talent with opportunities across the globe</p>
                </div>
            </div>
            <div class="text-center row g-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">
                                <span class="counter">1500</span>
                                <span class="plus">+</span>
                            </div>
                            <p class="stat-label">Active Jobs</p>
                        </div>
                        <div class="stat-footer">
                            <span class="stat-trend positive">
                                <i class="bi bi-graph-up-arrow"></i> 12% growth
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">
                                <span class="counter">50</span>
                                <span class="plus">+</span>
                            </div>
                            <p class="stat-label">Partner Institutes</p>
                        </div>
                        <div class="stat-footer">
                            <span class="stat-trend positive">
                                <i class="bi bi-graph-up-arrow"></i> 8% growth
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">
                                <span class="counter">10000</span>
                                <span class="plus">+</span>
                            </div>
                            <p class="stat-label">Job Seekers</p>
                        </div>
                        <div class="stat-footer">
                            <span class="stat-trend positive">
                                <i class="bi bi-graph-up-arrow"></i> 25% growth
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-building-check"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">
                                <span class="counter">200</span>
                                <span class="plus">+</span>
                            </div>
                            <p class="stat-label">Employers</p>
                        </div>
                        <div class="stat-footer">
                            <span class="stat-trend positive">
                                <i class="bi bi-graph-up-arrow"></i> 15% growth
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="py-5 featured-jobs">
        <div class="container">
            <h2 class="mb-5 text-center section-title" data-aos="fade-up">Featured Job Opportunities</h2>
            <div class="row">
                @forelse($featuredJobs->take(3) as $job)
                <!-- Job Card -->
                <div class="mb-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="p-4 bg-white rounded shadow-sm job-card h-100">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="p-2 rounded company-logo bg-light me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <span class="mb-0 h4 text-primary fw-bold">{{ substr($job->company_name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $job->title }}</h5>
                                <p class="mb-0 text-muted">{{ $job->company_name }}</p>
                            </div>
                        </div>
                        <div class="mb-3 job-details">
                            <p class="mb-2"><i class="bi bi-geo-alt me-2"></i>{{ $job->job_location }}</p>
                            <p class="mb-2"><i class="bi bi-clock me-2"></i>{{ $job->job_type_label }}</p>
                            @if($job->salary_type == \App\Models\JobPost::SALARY_NEGOTIABLE)
                                <p class="mb-2"><i class="bi bi-cash me-2"></i>{{ $job->salary_type_label }}</p>
                            @else
                                <p class="mb-2"><i class="bi bi-cash me-2"></i>{{ $job->salary }} ({{ $job->salary_type_label }})</p>
                            @endif
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('frontend.jobs.show', $job->id) }}" class="btn btn-outline-primary">Apply Now</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center col-12">
                    <p>No featured jobs available at the moment.</p>
                </div>
                @endforelse
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('frontend.jobs') }}" class="btn btn-primary">View All Jobs</a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 how-it-works bg-light">
        <div class="container">
            <h2 class="mb-5 text-center section-title" data-aos="fade-up">How InstHire Works</h2>
            <div class="row">
                <div class="mb-4 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center step-card">
                        <div class="mx-auto step-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h4>Create Profile</h4>
                        <p class="text-muted">Sign up and create your professional profile with your skills and experience.</p>
                    </div>
                </div>
                <div class="mb-4 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center step-card">
                        <div class="mx-auto step-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4>Search Jobs</h4>
                        <p class="text-muted">Browse through thousands of job opportunities that match your skills.</p>
                    </div>
                </div>
                <div class="mb-4 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center step-card">
                        <div class="mx-auto step-icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <h4>Get Hired</h4>
                        <p class="text-muted">Apply to jobs, connect with employers, and land your dream position.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-white cta-section">
        <div class="container position-relative">
            <div class="cta-box">
                <div class="row align-items-center">
                    <div class="mb-4 col-lg-7 mb-lg-0">
                        <h2 class="mb-3 display-5 fw-bold" data-aos="fade-right">Ready to Take the Next Step in Your Career?</h2>
                        <p class="mb-4 lead" data-aos="fade-right" data-aos-delay="100">
                            Join thousands of professionals who trust InstHire for their career growth. Get access to:
                        </p>
                        <div class="row g-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <span>Exclusive Job Opportunities</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <span>Direct Institute Connections</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <span>Professional Network</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <span>Career Growth Resources</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center col-lg-5 text-lg-end" data-aos="fade-left">
                        <div class="cta-buttons">
                            <a href="{{ route('student.login') }}" class="mb-2 btn btn-light btn-lg mb-sm-0">
                                <i class="bi bi-person-plus me-2"></i>Sign Up Now
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg ms-sm-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta-shape-1"></div>
            <div class="cta-shape-2"></div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .section-title {
        font-weight: 700;
        margin-bottom: 3rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -1rem;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 2px;
    }
</style>
@endpush

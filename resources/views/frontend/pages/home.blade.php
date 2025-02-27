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
                        <form action="#" method="GET" class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" placeholder="Job title or keyword">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-grid"></i>
                                    </span>
                                    <select class="form-select border-start-0">
                                        <option selected>Select Category</option>
                                        <option>Web Development</option>
                                        <option>Mobile Development</option>
                                        <option>UI/UX Design</option>
                                        <option>Data Science</option>
                                        <option>Marketing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Our Impact in Numbers</h2>
                    <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Connecting talent with opportunities across the globe</p>
                </div>
            </div>
            <div class="row text-center g-4">
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
                <!-- Job Card 1 -->
                <div class="mb-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4 bg-white rounded shadow-sm job-card h-100">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="company-logo me-3 d-flex align-items-center justify-content-center bg-light">
                                <span class="h4 mb-0">G</span>
                            </div>
                            <div>
                                <h5 class="mb-1">Senior Software Engineer</h5>
                                <p class="mb-0 text-muted">Google</p>
                            </div>
                        </div>
                        <div class="mb-3 job-details">
                            <p class="mb-2"><i class="bi bi-geo-alt me-2"></i>Mountain View, CA</p>
                            <p class="mb-2"><i class="bi bi-clock me-2"></i>Full Time</p>
                            <p class="mb-2"><i class="bi bi-cash me-2"></i>$120K - $180K</p>
                        </div>
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary">Apply Now</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="mb-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 bg-white rounded shadow-sm job-card h-100">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="company-logo me-3 d-flex align-items-center justify-content-center bg-light">
                                <span class="h4 mb-0">F</span>
                            </div>
                            <div>
                                <h5 class="mb-1">Product Designer</h5>
                                <p class="mb-0 text-muted">Facebook</p>
                            </div>
                        </div>
                        <div class="mb-3 job-details">
                            <p class="mb-2"><i class="bi bi-geo-alt me-2"></i>Menlo Park, CA</p>
                            <p class="mb-2"><i class="bi bi-clock me-2"></i>Full Time</p>
                            <p class="mb-2"><i class="bi bi-cash me-2"></i>$100K - $160K</p>
                        </div>
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary">Apply Now</a>
                        </div>
                    </div>
                </div>

                <!-- Job Card 3 -->
                <div class="mb-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4 bg-white rounded shadow-sm job-card h-100">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="company-logo me-3 d-flex align-items-center justify-content-center bg-light">
                                <span class="h4 mb-0">A</span>
                            </div>
                            <div>
                                <h5 class="mb-1">Data Scientist</h5>
                                <p class="mb-0 text-muted">Amazon</p>
                            </div>
                        </div>
                        <div class="mb-3 job-details">
                            <p class="mb-2"><i class="bi bi-geo-alt me-2"></i>Seattle, WA</p>
                            <p class="mb-2"><i class="bi bi-clock me-2"></i>Full Time</p>
                            <p class="mb-2"><i class="bi bi-cash me-2"></i>$130K - $190K</p>
                        </div>
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">View All Jobs</a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 how-it-works bg-light">
        <div class="container">
            <h2 class="mb-5 text-center section-title" data-aos="fade-up">How InstHire Works</h2>
            <div class="row">
                <div class="mb-4 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card text-center">
                        <div class="step-icon mx-auto">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h4>Create Profile</h4>
                        <p class="text-muted">Sign up and create your professional profile with your skills and experience.</p>
                    </div>
                </div>
                <div class="mb-4 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card text-center">
                        <div class="step-icon mx-auto">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4>Search Jobs</h4>
                        <p class="text-muted">Browse through thousands of job opportunities that match your skills.</p>
                    </div>
                </div>
                <div class="mb-4 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card text-center">
                        <div class="step-icon mx-auto">
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
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <h2 class="display-5 fw-bold mb-3" data-aos="fade-right">Ready to Take the Next Step in Your Career?</h2>
                        <p class="lead mb-4" data-aos="fade-right" data-aos-delay="100">
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
                    <div class="col-lg-5 text-center text-lg-end" data-aos="fade-left">
                        <div class="cta-buttons">
                            <a href="{{ route('student.login') }}" class="btn btn-light btn-lg mb-2 mb-sm-0">
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

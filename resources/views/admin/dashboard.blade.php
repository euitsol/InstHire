@extends('admin.layouts.master', ['page_slug' => 'dashboard'])
@section('title', 'Admin Dashboard')
@section('content')
    <h1 class="h2 mb-4 text-gray-700">Welcome back, Alex!</h1>
    <div class="row g-4">
        <!-- Recent Job Listings -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title h5 mb-3">
                        <i class="bi bi-briefcase me-2"></i>Recent Job Listings
                    </h2>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="me-2 text-primary">•</span>
                            <a href="#" class="text-decoration-none text-gray-600">Software Developer
                                Intern</a>
                        </li>
                        <li class="mb-2">
                            <span class="me-2 text-primary">•</span>
                            <a href="#" class="text-decoration-none text-gray-600">Marketing
                                Assistant</a>
                        </li>
                        <li class="mb-2">
                            <span class="me-2 text-primary">•</span>
                            <a href="#" class="text-decoration-none text-gray-600">Data Analyst</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Your Applications -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title h5 mb-3">
                        <i class="bi bi-file-text me-2"></i>Your Applications
                    </h2>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-gray-600">Web Designer</span>
                            <span class="status-badge review">Under Review</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-gray-600">Junior Project Manager</span>
                            <span class="status-badge pending">Pending</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title h5 mb-3">
                        <i class="bi bi-calendar-event me-2"></i>Upcoming Events
                    </h2>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-gray-600">Career Fair</span>
                            <small class="text-gray-500">May 15, 2025</small>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-gray-600">Resume Workshop</span>
                            <small class="text-gray-500">June 2, 2025</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- New row for Chart and Wizard -->
    <div class="row mt-4 g-4">
        <!-- Job Application Analytics Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title h5 mb-3">
                        <i class="bi bi-bar-chart me-2"></i>Job Application Analytics
                    </h2>
                    <canvas id="jobApplicationChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Onboarding Wizard -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title h5 mb-3">
                        <i class="bi bi-person me-2"></i>Complete Your Profile
                    </h2>
                    <div id="onboardingWizard">
                        <div class="wizard-step active" data-step="1">
                            <h3 class="h6 mb-3">Personal Information</h3>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="wizard-step" data-step="2">
                            <h3 class="h6 mb-3">Education</h3>
                            <div class="mb-3">
                                <label for="university" class="form-label">University</label>
                                <input type="text" class="form-control" id="university" name="university">
                            </div>
                            <div class="mb-3">
                                <label for="degree" class="form-label">Degree</label>
                                <select class="form-select" id="degree" name="degree">
                                    <option value="">Select...</option>
                                    <option value="Bachelor">Bachelor</option>
                                    <option value="Master">Master</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            </div>
                        </div>
                        <div class="wizard-step" data-step="3">
                            <h3 class="h6 mb-3">Work Experience</h3>
                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
                            <button class="btn btn-primary" id="nextBtn">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@push('scripts')
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
@endpush

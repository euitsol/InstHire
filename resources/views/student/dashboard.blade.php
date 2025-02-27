@extends('student.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="px-4 container-fluid">
    <!-- Welcome Section -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">Welcome back, John Doe!</h1>
            <p class="text-muted">Here's what's happening with your job applications.</p>
        </div>
        <div>
            <a href="javascript:void(0)" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Apply for Jobs
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="mb-4 row g-4">
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card fade-in">
                <div class="stats-card-icon" style="background-color: var(--primary-600)">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="stats-card-value">24</div>
                <div class="stats-card-label">Available Jobs</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card fade-in">
                <div class="stats-card-icon" style="background-color: var(--success-600)">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="stats-card-value">8</div>
                <div class="stats-card-label">Applied Jobs</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card fade-in">
                <div class="stats-card-icon" style="background-color: var(--warning-600)">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div class="stats-card-value">3</div>
                <div class="stats-card-label">Upcoming Job Fairs</div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="stats-card fade-in">
                <div class="stats-card-icon" style="background-color: var(--danger-600)">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-card-value">2</div>
                <div class="stats-card-label">Scheduled Interviews</div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="row">
        <div class="col-12">
            <div class="rounded-xl shadow-sm card">
                <div class="py-3 bg-white card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Job Applications</h5>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>
                </div>
                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>JOB TITLE</th>
                                    <th>COMPANY</th>
                                    <th>APPLIED DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-inline-block me-3">
                                                <div class="text-white rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                     style="width: 40px; height: 40px">
                                                    G
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Senior Software Engineer</h6>
                                                <small class="text-muted">San Francisco, CA</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Google Inc.</td>
                                    <td>25 Feb 2024</td>
                                    <td>
                                        <span class="badge bg-warning">
                                            Pending
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           class="btn btn-sm btn-light"
                                           data-bs-toggle="tooltip"
                                           title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-inline-block me-3">
                                                <div class="text-white rounded-circle bg-info d-flex align-items-center justify-content-center"
                                                     style="width: 40px; height: 40px">
                                                    M
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Full Stack Developer</h6>
                                                <small class="text-muted">New York, NY</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Microsoft</td>
                                    <td>20 Feb 2024</td>
                                    <td>
                                        <span class="badge bg-success">
                                            Accepted
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           class="btn btn-sm btn-light"
                                           data-bs-toggle="tooltip"
                                           title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-inline-block me-3">
                                                <div class="text-white rounded-circle bg-danger d-flex align-items-center justify-content-center"
                                                     style="width: 40px; height: 40px">
                                                    A
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Frontend Developer</h6>
                                                <small class="text-muted">Seattle, WA</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Amazon</td>
                                    <td>15 Feb 2024</td>
                                    <td>
                                        <span class="badge bg-info">
                                            Interviewing
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           class="btn btn-sm btn-light"
                                           data-bs-toggle="tooltip"
                                           title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endpush

@extends('student.layouts.master')

@section('title', 'My Job Applications')

@section('content')
<div class="px-4 container-fluid">
    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0 text-gray-800 h3">My Job Applications</h1>
            <p class="text-muted">View and manage your job applications</p>
        </div>
        <div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Applications List -->
    <div class="mb-4 rounded-xl shadow-sm card">
        <div class="py-3 bg-white card-header border-bottom">
            <h4 class="mb-0 card-title">Applied Jobs</h4>
        </div>
        <div class="card-body">
            @if($applications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Job Title</th>
                                <th scope="col">Company</th>
                                <th scope="col">Applied Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-truncate" style="max-width: 200px;">
                                            {{ $application->jobPost->title }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 rounded company-logo bg-light me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <span class="mb-0 h6 text-primary fw-bold">{{ substr($application->jobPost->company_name, 0, 1) }}</span>
                                            </div>
                                            <div class="text-truncate" style="max-width: 150px;">
                                                {{ $application->jobPost->company_name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $application->status_color }}">{{ $application->status_label }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('student.job.show', $application->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $applications->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="py-5 text-center">
                    <img src="{{ asset('frontend/images/no-data.svg') }}" alt="No Applications Found" class="mb-4 img-fluid" style="max-width: 200px;">
                    <h4>No Job Applications Found</h4>
                    <p class="text-muted">You haven't applied to any jobs yet.</p>
                    <a href="{{ route('frontend.jobs') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-briefcase"></i> Browse Jobs
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .company-logo {
        min-width: 36px;
    }
    
    .table td, .table th {
        padding: 1rem;
    }
</style>
@endpush

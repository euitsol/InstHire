@extends('employee.layouts.master')

@section('title', 'My Applications')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">My Job Applications</h5>
                </div>
                <div class="card-body">
                    @if($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Institute</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td>{{ $application->job->title }}</td>
                                            <td>{{ $application->job->institute->name }}</td>
                                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $application->status_color }}">
                                                    {{ $application->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('employee.applications.show', $application->id) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $applications->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-file-earmark-text fs-1 text-muted"></i>
                            <p class="mt-2 mb-0">You haven't applied to any jobs yet.</p>
                            <a href="{{ route('employee.jobs.index') }}" class="btn btn-primary mt-3">
                                Browse Jobs
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

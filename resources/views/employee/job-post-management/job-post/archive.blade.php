@extends('employee.layouts.master')
@section('title', 'Archived Job Posts')

@push('style_links')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Archived Job Post List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="card-title mb-0">{{ __('Archived Job Posts') }}</h2>
                <a href="{{ route('employee.job-posts.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ __('Back to Active Jobs') }}
                </a>
            </div>

            <div class="table-responsive">
                <table class="table" id="archivedJobPostTable">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Deadline') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ optional($job->category)->title }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $job->job_type_label }}</span>
                                </td>
                                <td>{{ date('d M, Y', strtotime($job->deadline)) }}</td>
                                <td>
                                    <span class="{{ $job->status_badge_color }}">
                                        {{ $job->job_status_label }}
                                    </span>
                                </td>
                                <td>{{ $job->created_at->format('d M, Y') }}</td>
                                <td>
                                    @include('employee.job-post-management.job-post.includes.archive-actions', [
                                        'show_url' => route('employee.job-post-management.job-post.show', $job),
                                        'profile_url' => route('employee.job-post-management.job-post.profile', $job)
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#archivedJobPostTable').DataTable({
                responsive: true,
                order: [[6, 'desc']]
            });
        });
    </script>
@endpush

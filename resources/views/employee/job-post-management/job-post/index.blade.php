@extends('employee.layouts.master')
@section('title', 'Job Posts')
@push('styles')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Job Post List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Job Posts') }}</h2>
                <a href="{{ route('employee.job-posts.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Create New Job Post') }}
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" id="jobPostTable">
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
                                    @include('employee.includes.action_buttons', [
                                        'menuItems' => [
                                            [
                                                'routeName' => 'employee.job-posts.show',
                                                'params' => [$job->id],
                                                'icon' => 'bi-eye',
                                                'label' => 'View Details',
                                                'className' => 'btn-info'
                                            ],
                                            [
                                                'routeName' => 'employee.job-posts.edit',
                                                'params' => [$job->id],
                                                'icon' => 'bi-pencil',
                                                'label' => 'Edit',
                                                'className' => 'btn-primary'
                                            ],
                                            [
                                                'routeName' => 'employee.job-posts.destroy',
                                                'params' => [$job->id],
                                                'icon' => 'bi-trash',
                                                'label' => 'Delete',
                                                'className' => 'btn-danger',
                                                'delete' => true
                                            ],
                                            // [
                                            //     'routeName' => 'employee.job-posts.status-change',
                                            //     'params' => [$job->id],
                                            //     'icon' => 'bi-arrow-clockwise',
                                            //     'label' => $job->status == 1 ? 'Mark as Inactive' : 'Mark as Active',
                                            //     'className' => $job->status == 1 ? 'btn-warning' : 'btn-success'
                                            // ]
                                        ]
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
            if (!$.fn.DataTable.isDataTable('#jobPostTable')) {
                $('#jobPostTable').DataTable({
                    responsive: true,
                    order: [[6, 'desc']]
                });
            }
        });
    </script>
@endpush

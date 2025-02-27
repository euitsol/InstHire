@extends('admin.layouts.master', ['page_slug' => 'job-post'])
@section('title', 'Job Posts')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Job Posts') }}</h2>
            </div>

            <table id="jobPostTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Job Type') }}</th>
                        <th>{{ __('Deadline') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobPosts as $jobPost)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jobPost->title }}</td>
                            <td>{{ $jobPost->company_name }}</td>
                            <td>{{ optional($jobPost->category)->title }}</td>
                            <td><span class="{{ $jobPost->job_type_color }}">{{ $jobPost->job_type_label }}</span></td>
                            <td>{{ date('d M, Y', strtotime($jobPost->deadline)) }}</td>
                            <td>
                                <span class="{{ $jobPost->status_badge_color }}">
                                    {{ $jobPost->status_label }}
                                </span>
                            </td>
                            <td>
                                @include('admin.includes.action_buttons', [
                                    'menuItems' => [
                                        [
                                            'routeName' => 'jm.job-post.show',
                                            'params' => [$jobPost->id],
                                            'className' => 'btn-secondary',
                                            'icon' => 'bi bi-eye',
                                            'label' => 'Details',
                                        ]
                                    ]
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('style_links')
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jobPostTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search job posts...",
                },
            });
        });
    </script>
@endpush

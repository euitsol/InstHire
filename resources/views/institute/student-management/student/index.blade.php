@extends('institute.layouts.master')
@section('title', 'Student List')

@push('style_links')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Employee List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Student List') }}</h2>
                <a href="{{ route('institute.student.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Student') }}
                </a>
            </div>

            <div class="table-responsive">
                <table class="table" id="studentTable">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Session') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ optional($student->session)->name }}</td>
                                <td>{{ optional($student->department)->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <span class="{{ $student->status_badge_color }}">
                                        {{ $student->status_label }}
                                    </span>
                                </td>
                                <td>{{ $student->created_at }}</td>
                                <td>
                                    @include('institute.includes.action_buttons', [
                                        'menuItems' => [
                                            [
                                                'routeName' => 'institute.student.edit',
                                                'params' => $student->id,
                                                'className' => 'btn-info',
                                                'icon' => 'bi bi-pencil',
                                                'label' => 'Edit',
                                            ],
                                            [
                                                'routeName' => 'institute.student.destroy',
                                                'className' => 'btn-danger',
                                                'params' => [$student->id],
                                                'label' => 'Delete',
                                                'icon' => 'bi bi-trash',
                                                'delete' => true,
                                            ],
                                        ],
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

@push('script_links')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#studentTable')) {
                $('#studentTable').DataTable({
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search employees...",
                    },
                    order: [
                        [5, 'desc']
                    ], // Sort by created_at by default
                    columnDefs: [{
                            orderable: false,
                            targets: [0, 6]
                        } // Disable sorting for image and actions columns
                    ],
                });
            }
        });
    </script>
@endpush

@extends('institute.layouts.master')
@section('title', 'Employee List')

@push('style_links')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Employee List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Employee List') }}</h2>
                <a href="{{ route('institute.employee.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> {{ __('Create Employee') }}</a>
            </div>

            <div class="table-responsive">
                <table class="table" id="employeeTable">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone ?? 'N/A' }}</td>
                                <td>
                                    <span class="{{ $employee->status_badge_color }}">
                                        {{ $employee->status_label }}
                                    </span>
                                </td>
                                <td>{{ $employee->created_at }}</td>
                                <td>
                                    @include('institute.includes.action_buttons', [
                                        'menuItems' => [
                                            [
                                                'routeName' => 'institute.employee.show',
                                                'params' => $employee->id,
                                                'className' => 'btn-secondary',
                                                'icon' => 'bi bi-eye',
                                                'label' => 'Details',
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

    {{-- Employee Details Modal  --}}
    @include('institute.includes.details_modal', ['modal_title' => 'Employee Details'])
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
            if (!$.fn.DataTable.isDataTable('#employeeTable')) {
                $('#employeeTable').DataTable({
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

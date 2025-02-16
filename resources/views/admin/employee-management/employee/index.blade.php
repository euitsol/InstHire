@extends('admin.layouts.master', ['page_slug' => 'employee'])
@section('title', 'Employee List')
@section('content')
    <!-- Employee List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Employee List') }}</h2>
                <a href="{{ route('em.employee.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Employee') }}
                </a>
            </div>

            <table id="employeeTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Verifier') }}</th>
                        <th>{{ __('Verified By') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>
                                @if ($employee->image)
                                    <img src="{{ asset('storage/' . $employee->image) }}" alt="Profile" class="rounded-circle"
                                        width="40" height="40">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="{{ $employee->status_badge_color }}">
                                    {{ $employee->status_label }}
                                </span>
                            </td>
                            <td>{{ $employee->verifier ? $employee->verifier->name : 'Admin'}}</td>
                            <td>{{ $employee->verified_by ? $employee->verified_by->name : 'N/A' }}</td>
                            <td>
                                @include('admin.includes.action_buttons', [
                                    'menuItems' => [
                                        [
                                            'routeName' => 'javascript:void(0)',
                                            'data-id' => $employee->id,
                                            'className' => 'btn-secondary view',
                                            'icon' => 'bi bi-eye',
                                            'label' => 'Details',
                                        ],
                                        [
                                            'routeName' => 'em.employee.profile',
                                            'params' => $employee->id,
                                            'className' => 'btn-info',
                                            'icon' => 'bi bi-person',
                                            'label' => 'Profile',
                                        ],
                                        [
                                            'routeName' => 'em.employee.edit',
                                            'params' => [$employee->id],
                                            'className' => 'btn-primary',
                                            'icon' => 'bi bi-pencil',
                                            'label' => 'Edit',
                                        ],

                                        [
                                            'routeName' => 'em.employee.destroy',
                                            'className' => 'btn-danger',
                                            'params' => [$employee->id],
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
    {{-- Employee Details Modal  --}}
    @include('admin.includes.details_modal', ['modal_title' => 'Employee Details'])
@endsection

@push('style_links')
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@push('script_links')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {

            // Datatable
            const table = $('#employeeTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search employees...",
                },
            });


            // Modal JS
            $('.view').on('click', function() {
                let id = $(this).data('id');
                let url = ("{{ route('em.employee.show', ['id']) }}");
                let _url = url.replace('id', id);
                $.ajax({
                    url: _url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var result = `
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-nowrap">Name</th>
                                        <th>:</th>
                                        <td>${data.name}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Image</th>
                                        <th>:</th>
                                        <td>`;
                        if (data.image) {
                            result += `<img src="${data.modify_image}" alt="Profile"
                                                class="rounded-circle" width="40" height="40">`;
                        } else {
                            result += `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">${data.modify_image}</div>`;
                        }
                        result += `
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Email</th>
                                        <th>:</th>
                                        <td>${data.email}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Phone</th>
                                        <th>:</th>
                                        <td>${data.phone}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Verifier</th>
                                        <th>:</th>
                                        <td>${data.verifier ? data.verifier.name : 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Verified By</th>
                                        <th>:</th>
                                        <td>${data.verified_by ? data.verified_by.name : 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Gender</th>
                                        <th>:</th>
                                        <td><span class="${data.gender_badge_color}">${data.gender_label}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Status</th>
                                        <th>:</th>
                                        <td><span class="${data.status_badge_color}">${data.status_label}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Created Date</th>
                                        <th>:</th>
                                        <td>${data.creating_time}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Updated Date</th>
                                        <th>:</th>
                                        <td>${data.updating_time}</td>
                                    </tr>
                                </table>
                                `;
                        $('.modal_data').html(result);
                        $('.view_modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching employee data:', error);
                    }
                });
            });
        });
    </script>
@endpush

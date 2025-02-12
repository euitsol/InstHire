@extends('admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Admin Dashboard')
@section('content')
    <!-- Admin List -->
    <div id="adminList" class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Admin List') }}</h2>
                <a href="{{ route('am.admin.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Admin') }}
                </a>
            </div>

            <table id="adminTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>
                                @if ($admin->image)
                                    <img src="{{ asset('storage/' . $admin->image) }}" alt="Profile" class="rounded-circle"
                                        width="40" height="40">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="{{ $admin->status_badge_color }}">
                                    {{ $admin->status_label }}
                                </span>
                            </td>
                            <td>
                                @include('admin.includes.action_buttons', [
                                    'menuItems' => [
                                        [
                                            'routeName' => 'javascript:void(0)',
                                            'data-id' => $admin->id,
                                            'className' => 'btn-secondary view',
                                            'icon' => 'bi bi-eye',
                                            'label' => 'Details',
                                        ],
                                        [
                                            'routeName' => 'am.admin.status',
                                            'className' => $admin->status_btn_color,
                                            'params' => [$admin->id],
                                            'label' => $admin->status_btn_label,
                                            'icon' => 'bi bi-power',
                                        ],
                                        [
                                            'routeName' => 'am.admin.edit',
                                            'params' => [$admin->id],
                                            'className' => 'btn-primary',
                                            'icon' => 'bi bi-pencil',
                                            'label' => 'Edit',
                                        ],
                                
                                        [
                                            'routeName' => 'am.admin.destroy',
                                            'className' => 'btn-danger',
                                            'params' => [$admin->id],
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
    {{-- Admin Details Modal  --}}
    @include('admin.includes.details_modal', ['modal_title' => 'Admin Details'])
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
            const table = $('#adminTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search admins...",
                },
            });


            // Modal JS
            $('.view').on('click', function() {
                let id = $(this).data('id');
                let url = ("{{ route('am.admin.show', ['id']) }}");
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
                        console.error('Error fetching admin data:', error);
                    }
                });
            });
        });
    </script>
@endpush

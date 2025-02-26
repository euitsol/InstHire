@extends('admin.layouts.master', ['page_slug' => 'institute'])
@section('title', 'Institute List')
@section('content')
    <!-- Institute List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Institute List') }}</h2>
                <a href="{{ route('im.institute.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Institute') }}
                </a>
            </div>

            <table id="instituteTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Responsible Person Name') }}</th>
                        <th>{{ __('Responsible Person Phone') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Created By') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($institutes as $institute)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $institute->name }}</td>
                            <td>{{ $institute->email }}</td>
                            <td>{{ $institute->responsible_person_name }}</td>
                            <td>{{ $institute->responsible_person_phone }}</td>
                            <td>
                                <span class="{{ $institute->status_badge_color }}">
                                    {{ $institute->status_label }}
                                </span>
                            </td>
                            <td>{{ date('d-m-Y', strtotime($institute->created_at)) }}</td>
                            <td>{{ creater_name($institute->creater) }}</td>
                            <td>
                                @include('admin.includes.action_buttons', [
                                    'menuItems' => [
                                        [
                                            'routeName' => 'javascript:void(0)',
                                            'data-id' => $institute->id,
                                            'className' => 'btn-secondary view',
                                            'icon' => 'bi bi-eye',
                                            'label' => 'Details',
                                        ],
                                        [
                                            'routeName' => 'im.institute.profile',
                                            'params' => $institute->id,
                                            'className' => 'btn-info',
                                            'icon' => 'bi bi-person',
                                            'label' => 'Profile',
                                        ],
                                        [
                                            'routeName' => 'im.institute.status',
                                            'className' => $institute->status_btn_color,
                                            'params' => [$institute->id],
                                            'label' => $institute->status_btn_label,
                                            'icon' => 'bi bi-power',
                                        ],
                                        [
                                            'routeName' => 'im.institute.edit',
                                            'params' => [$institute->id],
                                            'className' => 'btn-primary',
                                            'icon' => 'bi bi-pencil',
                                            'label' => 'Edit',
                                        ],

                                        [
                                            'routeName' => 'im.institute.destroy',
                                            'className' => 'btn-danger',
                                            'params' => [$institute->id],
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
    {{-- Institute Details Modal  --}}
    @include('admin.includes.details_modal', ['modal_title' => 'Institute Details'])
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
            const table = $('#instituteTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search institutes...",
                },
            });


            // Modal JS
            $('.view').on('click', function() {
                let id = $(this).data('id');
                let url = ("{{ route('im.institute.show', ['id']) }}");
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
                            result += `<img src="${data.image}" alt="Profile"
                                                class="rounded-circle" width="40" height="40">`;
                        } else {
                            result += `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;">${data.image}</div>`;
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
                                        <th class="text-nowrap">Responsible Person Name</th>
                                        <th>:</th>
                                        <td>${data.responsible_person_name}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Responsible Person Phone</th>
                                        <th>:</th>
                                        <td>${data.responsible_person_phone}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Status</th>
                                        <th>:</th>
                                        <td><span class="${data.status_badge_color}">${data.status_label}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Created By</th>
                                        <th>:</th>
                                        <td>${data.creater ? data.creater.name : 'Null'}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Updated By</th>
                                        <th>:</th>
                                        <td>${data.updater ? data.updater.name : 'Null'}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Created Date</th>
                                        <th>:</th>
                                        <td>${data.created_at}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Updated Date</th>
                                        <th>:</th>
                                        <td>${data.updated_at}</td>
                                    </tr>
                                </table>
                                `;
                        $('.modal_data').html(result);
                        $('.view_modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching institute data:', error);
                    }
                });
            });
        });
    </script>
@endpush

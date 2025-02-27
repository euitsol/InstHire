@extends('admin.layouts.master', ['page_slug' => 'job-category'])
@section('title', 'Job Categories')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Job Categories') }}</h2>
                <a href="{{ route('jm.job-category.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Category') }}
                </a>
            </div>

            <table id="jobCategoryTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Created By') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobCategories as $jobCategory)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jobCategory->title }}</td>
                            <td>{{ $jobCategory->slug }}</td>
                            <td>
                                <span class="{{ $jobCategory->status_badge_color }}">
                                    {{ $jobCategory->status_label }}
                                </span>
                            </td>
                            <td>{{ $jobCategory->created_at }}</td>
                            <td>{{ $jobCategory->creater ? $jobCategory->creater->name : 'System'}}</td>
                            <td>
                                @include('admin.includes.action_buttons', [
                                    'menuItems' => [
                                        [
                                            'routeName' => 'javascript:void(0)',
                                            'data-id' => $jobCategory->id,
                                            'className' => 'btn-secondary view',
                                            'icon' => 'bi bi-eye',
                                            'label' => 'Details',
                                        ],
                                        [
                                            'routeName' => 'jm.job-category.status',
                                            'className' => $jobCategory->status_btn_color,
                                            'params' => [$jobCategory->id],
                                            'icon' => $jobCategory->status_btn_icon,
                                            'label' => $jobCategory->status_btn_label,
                                        ],
                                        [
                                            'routeName' => 'jm.job-category.edit',
                                            'params' => [$jobCategory->id],
                                            'className' => 'btn-primary',
                                            'icon' => 'bi bi-pencil',
                                            'label' => 'Edit',
                                        ],
                                        [
                                            'routeName' => 'jm.job-category.destroy',
                                            'params' => [$jobCategory->id],
                                            'className' => 'btn-danger delete',
                                            'icon' => 'bi bi-trash',
                                            'label' => 'Delete',
                                        ],
                                    ]
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   {{-- Job Category Details Modal  --}}
   @include('admin.includes.details_modal', ['modal_title' => 'Job Category Details'])
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
            // Datatable
            const table = $('#jobCategoryTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search job categories...",
                },
            });

            // Modal JS
            $('.view').on('click', function() {
                let id = $(this).data('id');
                let url = ("{{ route('jm.job-category.show', ['id']) }}");
                let _url = url.replace('id', id);
                $.ajax({
                    url: _url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var result = `
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-nowrap">Title</th>
                                        <th>:</th>
                                        <td>${data.title}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Slug</th>
                                        <th>:</th>
                                        <td>${data.slug}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Status</th>
                                        <th>:</th>
                                        <td><span class="${data.status_badge_color}">${data.status_label}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Created By</th>
                                        <th>:</th>
                                        <td>${data.creater ? data.creater.name : 'System'}</td>
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
                        console.error('Error fetching job category data:', error);
                    }
                });
            });
        });
    </script>
@endpush

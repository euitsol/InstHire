@extends('institute.layouts.master')
@section('title', 'Job Fair Stall Options')

@push('style_links')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Stall Options List -->
    <div class="mb-4 card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="mb-0 card-title">{{ __('Job Fair Stall Options') }}</h2>
                <a href="{{ route('institute.setup.jfs.create') }}" type="button" class="btn btn-primary" id="addNew">
                    <i class="bi bi-plus"></i> {{ __('Add New Stall Option') }}
                </a>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table" id="stallOptionTable">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Stall Size') }}</th>
                            <th>{{ __('Max Representatives') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stallOptions as $option)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $option->stall_size }}</td>
                                <td>{{ $option->maximum_representative }}</td>
                                <td>
                                    <span class="{{ $option->status == App\Models\JobFairStallOption::STATUS_ACTIVE ? 'badge bg-success' : 'badge bg-danger' }}">
                                        {{ $option->status == App\Models\JobFairStallOption::STATUS_ACTIVE ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $option->created_at }}</td>
                                <td>
                                    @include('institute.includes.action_buttons', [
                                        'menuItems' => [
                                            [
                                                'routeName' => 'javascript:void(0)',
                                                'data-id' => $option->id,
                                                'className' => 'btn-info view-details',
                                                'icon' => 'bi bi-eye',
                                                'label' => 'View Details',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.jfs.edit',
                                                'params' => $option->id,
                                                'className' => 'btn-primary edit',
                                                'icon' => 'bi bi-pencil',
                                                'label' => 'Edit',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.jfs.toggle-status',
                                                'params' => $option->id,
                                                'className' => 'btn-warning toggle-status',
                                                'icon' => 'bi bi-toggle-on',
                                                'label' => 'Toggle Status',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.jfs.delete',
                                                'params' => [$option->id],
                                                'className' => 'btn-danger delete',
                                                'delete' => true,
                                                'icon' => 'bi bi-trash',
                                                'label' => 'Delete',
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

    {{-- Details Modal --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Stall Option Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detailsContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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
            // Initialize DataTable
            if (!$.fn.DataTable.isDataTable('#stallOptionTable')) {
                $('#stallOptionTable').DataTable({
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search stall options...",
                    },
                    order: [
                        [3, 'desc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [4]
                    }],
                });
            }

            // Show details modal
            $('.view-details').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ route('institute.setup.jfs.show', ':id') }}".replace(':id', id);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#detailsModal').modal('show');
                        $('#detailsModalLabel').text('Stall Option Details');

                        // Populate details in the modal
                        let detailsHtml = `
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Stall Size</th>
                                        <td>${data.stall_size}</td>
                                    </tr>
                                    <tr>
                                        <th>Maximum Representatives</th>
                                        <td>${data.maximum_representative}</td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td>${data.description}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="${data.status == {{ App\Models\JobFairStallOption::STATUS_ACTIVE }} ? 'badge bg-success' : 'badge bg-danger'}">
                                                ${data.status == {{ App\Models\JobFairStallOption::STATUS_ACTIVE }} ? 'Active' : 'Inactive'}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>${data.created_at}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>${data.updated_at}</td>
                                    </tr>
                                </table>
                            </div>
                        `;
                        $('#detailsContent').html(detailsHtml);
                    },
                    error: function() {
                        showAlert('error', 'Failed to load stall option details');
                    }
                });
            });
        });
    </script>
@endpush

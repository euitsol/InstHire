@extends('institute.layouts.master')
@section('title', 'Session List')

@push('style_links')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Session List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-0">{{ __('Session List') }}</h2>
                <button type="button" class="btn btn-primary" id="addNew">
                    <i class="bi bi-plus"></i> {{ __('Add New Session') }}
                </button>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table" id="sessionTable">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->name }}</td>
                                <td>
                                    <span class="{{ $session->status_badge_color }}">
                                        {{ $session->status_label }}
                                    </span>
                                </td>
                                <td>{{ $session->created_at }}</td>
                                <td>
                                    @include('institute.includes.action_buttons', [
                                        'menuItems' => [
                                            [
                                                'routeName' => 'javascript:void(0)',
                                                'data-id' => $session->id,
                                                'className' => 'btn-info edit',
                                                'icon' => 'bi bi-pencil',
                                                'label' => 'Edit',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.session.toggle-status',
                                                'params' => $session->id,
                                                'className' => 'btn-warning toggle-status',
                                                'icon' => 'bi bi-toggle-on',
                                                'label' => 'Toggle Status',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.session.delete',
                                                'params' => [$session->id],
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

    {{-- Form Modal --}}
    @include('institute.includes.form_modal', ['modal_title' => 'Session Form'])
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
            if (!$.fn.DataTable.isDataTable('#sessionTable')) {
                $('#sessionTable').DataTable({
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search sessions...",
                    },
                    order: [
                        [2, 'desc']
                    ], // Sort by created_at by default
                    columnDefs: [{
                            orderable: false,
                            targets: [3]
                        } // Disable sorting for actions column
                    ],
                });
            }

            // Show create modal
            $('#addNew').on('click', function() {
                $('#formModal').modal('show');
                $('#dataForm').attr('action', "{{ route('institute.setup.session.store') }}");
                $('#dataForm').attr('method', 'POST');
                $('#formModalLabel').text('Add New Session');
                $('#dataForm')[0].reset();
                $('#formErrors').addClass('d-none').find('ul').html('');
            });

            // Show edit modal
            $('.edit').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ route('institute.setup.session.show', ':id') }}".replace(':id', id);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#formModal').modal('show');
                        $('#dataForm').attr('action',
                            "{{ route('institute.setup.session.update', ':id') }}"
                            .replace(':id', id));
                        $('#dataForm').attr('method', 'POST');
                        $('#formModalLabel').text('Edit Session');
                        $('#name').val(data.name);
                        $('#status').val(data.status ? '1' : '0');
                        $('#formErrors').addClass('d-none').find('ul').html('');
                    },
                    error: function() {
                        showAlert('error', 'Failed to load session data');
                    }
                });
            });
        });
    </script>
@endpush

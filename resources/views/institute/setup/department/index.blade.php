@extends('institute.layouts.master')
@section('title', 'Department List')

@push('style_links')
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Department List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-0">{{ __('Department List') }}</h2>
                <button type="button" class="btn btn-primary" id="addNew">
                    <i class="bi bi-plus"></i> {{ __('Add New Department') }}
                </button>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table" id="departmentTable">
                    <thead>
                        <tr>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <span class="{{ $department->status_badge_color }}">
                                        {{ $department->status_label }}
                                    </span>
                                </td>
                                <td>{{ $department->created_at }}</td>
                                <td>
                                    @include('institute.includes.action_buttons', [
                                        'menuItems' => [
                                            [
                                                'routeName' => 'javascript:void(0)',
                                                'data-id' => $department->id,
                                                'className' => 'btn-info edit',
                                                'icon' => 'bi bi-pencil',
                                                'label' => 'Edit',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.department.toggle-status',
                                                'params' => $department->id,
                                                'className' => 'btn-warning toggle-status',
                                                'icon' => 'bi bi-toggle-on',
                                                'label' => 'Toggle Status',
                                            ],
                                            [
                                                'routeName' => 'institute.setup.department.delete',
                                                'params' => [$department->id],
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
    @include('institute.includes.form_modal', ['modal_title' => 'Department Form'])
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
            if (!$.fn.DataTable.isDataTable('#departmentTable')) {
                $('#departmentTable').DataTable({
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search departments...",
                    },
                    order: [
                        [2, 'desc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [3]
                    }],
                });
            }

            // Reset form and errors when modal is closed
            $('#formModal').on('hidden.bs.modal', function() {
                $('#dataForm')[0].reset();
                $('#formErrors').addClass('d-none').find('ul').html('');
            });

            // Show create modal
            $('#addNew').on('click', function() {
                $('#formModal').modal('show');
                $('#dataForm').attr('action', "{{ route('institute.setup.department.store') }}");
                $('#dataForm').attr('method', 'POST');
                $('#formModalLabel').text('Add New Department');
                $('#dataForm')[0].reset();
                $('#formErrors').addClass('d-none').find('ul').html('');
            });

            // Show edit modal
            $('.edit').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ route('institute.setup.department.show', ':id') }}".replace(':id', id);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#formModal').modal('show');
                        $('#dataForm').attr('action',
                            "{{ route('institute.setup.department.update', ':id') }}"
                            .replace(':id', id));
                        $('#dataForm').attr('method', 'POST');
                        $('#method').val('PUT');
                        $('#formModalLabel').text('Edit Department');
                        $('#name').val(data.name);
                        $('#status').val(data.status ? '1' : '0');
                        $('#formErrors').addClass('d-none').find('ul').html('');
                    },
                    error: function() {
                        showAlert('error', 'Failed to load department data');
                    }
                });
            });

            // Handle form submission
            $('#dataForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                
                $.ajax({
                    url: url,
                    method: method,
                    data: form.serialize(),
                    success: function(response) {
                        $('#formModal').modal('hide');
                        showAlert('success', response.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorHtml = '';
                            $.each(errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                            $('#formErrors').removeClass('d-none').find('ul').html(errorHtml);
                        } else {
                            showAlert('error', 'An error occurred while processing your request');
                        }
                    }
                });
            });
        });
    </script>
@endpush

@extends('admin.layouts.master', ['page_slug' => 'subscription'])
@section('title', 'Subscription List')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Subscription List') }}</h2>
                <a href="{{ route('sm.subscription.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Subscription') }}
                </a>
            </div>

            <table id="subscriptionTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Validity') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>
                                @if ($subscription->image)
                                    <img src="{{ asset('storage/' . $subscription->image) }}" alt="Profile"
                                        class="rounded-circle" width="40" height="40">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($subscription->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $subscription->title }}</td>
                            <td>{{ number_format($subscription->price, 2) }} BDT</td>
                            <td>{{ $subscription->validity }}</td>
                            <td>
                                <span class="{{ $subscription->status_badge_color }}">
                                    {{ $subscription->status_label }}
                                </span>
                            </td>
                            <td>
                                @include('admin.includes.action_buttons', [
                                    'menuItems' => [
                                        [
                                            'routeName' => 'javascript:void(0)',
                                            'data-id' => $subscription->id,
                                            'className' => 'btn-secondary view',
                                            'icon' => 'bi bi-eye',
                                            'label' => 'Details',
                                        ],
                                        [
                                            'routeName' => 'sm.subscription.status',
                                            'className' => $subscription->status_btn_color,
                                            'params' => [$subscription->id],
                                            'label' => $subscription->status_btn_label,
                                            'icon' => 'bi bi-power',
                                        ],
                                        [
                                            'routeName' => 'sm.subscription.edit',
                                            'params' => [$subscription->id],
                                            'className' => 'btn-primary',
                                            'icon' => 'bi bi-pencil',
                                            'label' => 'Edit',
                                        ],
                                
                                        [
                                            'routeName' => 'sm.subscription.destroy',
                                            'className' => 'btn-danger',
                                            'params' => [$subscription->id],
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
    {{-- Subscription Details Modal  --}}
    @include('admin.includes.details_modal', ['modal_title' => 'Subscription Details'])
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
            const table = $('#subscriptionTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search subscriptions...",
                },
            });


            // Modal JS
            $('.view').on('click', function() {
                let id = $(this).data('id');
                let url = ("{{ route('sm.subscription.show', ['id']) }}");
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
                                        <th class="text-nowrap">Price</th>
                                        <th>:</th>
                                        <td>${data.price}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Validity</th>
                                        <th>:</th>
                                        <td>${data.validity}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Status</th>
                                        <th>:</th>
                                        <td><span class="${data.status_badge_color}">${data.status_label}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Description</th>
                                        <th>:</th>
                                        <td>${data.description}</td>
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
                        console.error('Error fetching subscription data:', error);
                    }
                });
            });
        });
    </script>
@endpush

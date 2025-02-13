@extends('admin.layouts.master', ['page_slug' => 'institute-subscription'])
@section('title', 'Institute Subscriptions')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">{{ __('Institute Subscriptions') }}</h2>
                            @include('admin.includes.button', [
                                'routeName' => 'sm.institute-subscription.create',
                                'label' => 'Create New',
                            ])
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped" id="instituteSubscriptionTable">
                                <thead class="text-center bg-light">
                                    <tr>
                                        <th width="5%">{{ __('#SL') }}</th>
                                        <th width="20%">{{ __('Institute') }}</th>
                                        <th width="20%">{{ __('Subscription') }}</th>
                                        <th width="15%">{{ __('Price') }}</th>
                                        <th width="15%">{{ __('Validity') }}</th>
                                        <th width="10%">{{ __('Status') }}</th>
                                        <th width="15%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($instituteSubscriptions as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->institute->name }}</td>
                                            <td>{{ $item->subscription->title }}</td>
                                            <td>{{ $item->subscription->price }} BDT</td>
                                            <td>{{ $item->subscription->validity }} Days</td>
                                            <td>
                                                <span class="{{ $item->status_badge_color }}">
                                                    {{ $item->status_label }}
                                                </span>
                                            </td>
                                            <td>
                                                @include('admin.includes.action_buttons', [
                                                    'menuItems' => [
                                                        [
                                                            'routeName' => 'sm.institute-subscription.show',
                                                            'params' => [$item->id],
                                                            'className' => 'btn-secondary',
                                                            'icon' => 'bi bi-eye',
                                                            'label' => 'Details',
                                                        ],

                                                        [
                                                            'routeName' => 'sm.institute-subscription.edit',
                                                            'params' => [$item->id],
                                                            'className' => 'btn-primary',
                                                            'icon' => 'bi bi-pencil',
                                                            'label' => 'Edit',
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
                </div>
            </div>
        </div>
    </div>
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
            const table = $('#instituteSubscriptionTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search institute subscriptions...",
                },
            });
        });
    </script>
@endpush

@extends('admin.layouts.master', ['page_slug' => 'subscription'])
@section('title', 'Subscription List')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="card-title mb-0">{{ __('Subscription List') }}</h2>
                <a href="{{ route('sm.subscription.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> {{ __('Add New Subscription') }}
                </a>
            </div>

            <div class="row g-4">
                @foreach ($subscriptions as $subscription)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 subscription-card">
                            <div class="position-relative">
                                @if ($subscription->image)
                                    <img src="{{ $subscription->image }}" class="card-img-top subscription-image" alt="{{ $subscription->title }}">
                                @else
                                    <div class="card-img-top subscription-image-placeholder d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-seam text-muted"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge {{ $subscription->status_badge_color }} rounded-pill">
                                        {{ $subscription->status_label }}
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 w-100 price-banner">
                                    <h4 class="text-white mb-0 px-3 py-2">{{ number_format($subscription->price, 2) }} <small>BDT</small></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $subscription->title }}</h5>
                                    <span class="badge bg-info rounded-pill">{{ $subscription->validity }} Days</span>
                                </div>
                                @if($subscription->description)
                                    <p class="card-text text-muted mb-3">{{ Str::limit($subscription->description, 100) }}</p>
                                @endif
                                <div class="action-buttons">
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
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- Subscription Details Modal  --}}
@include('admin.includes.details_modal', ['modal_title' => 'Subscription Details'])

@push('style_links')
    <style>
        .subscription-card {
            transition: transform 0.2s;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .subscription-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        .subscription-image, .subscription-image-placeholder {
            height: 200px;
            object-fit: cover;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        }
        .subscription-image-placeholder i {
            font-size: 3rem;
        }
        .price-banner {
            background: linear-gradient(to right, rgba(40,167,69,0.9), rgba(32,201,151,0.9));
            backdrop-filter: blur(5px);
        }
        .action-buttons {
            border-top: 1px solid rgba(0,0,0,0.05);
            padding-top: 1rem;
            margin-top: auto;
        }
        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }
        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
@endpush

@push('script_links')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Modal JS
            $('.view').on('click', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: window.AppConfig.urls.subscription.show.replace(':id', id),
                    type: "GET",
                    success: function(response) {
                        let subscription = response;
                        let modalBody = $('.view_modal .modal_data');

                        // Build the details HTML
                        let html = `
                            <div class="row">
                                <div class="col-md-4">
                                    ${subscription.image ?
                                        `<img src="${subscription.image}" alt="${subscription.title}" class="img-fluid rounded mb-3">` :
                                        `<div class="bg-light rounded mb-3 d-flex align-items-center justify-content-center" style="height: 200px">
                                            <i class="bi bi-image text-muted display-1"></i>
                                        </div>`
                                    }
                                </div>
                                <div class="col-md-8">
                                    <table class="table">
                                        <tr>
                                            <th width="150">Title</th>
                                            <td>${subscription.title}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${subscription.price} BDT</td>
                                        </tr>
                                        <tr>
                                            <th>Validity</th>
                                            <td>${subscription.validity} Days</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><span class="${subscription.status_badge_color}">${subscription.status_label}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>${subscription.description}</td>
                                        </tr>
                                        <tr>
                                            <th>Created By</th>
                                            <td>${subscription.creater_admin ? subscription.creater_admin.name : 'Null'}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated By</th>
                                            <td>${subscription.updater_admin ? subscription.updater_admin.name : 'Null'}</td>
                                        </tr>
                                        <tr>
                                            <th>Created Date</th>
                                            <td>${subscription.created_at}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated Date</th>
                                            <td>${subscription.updated_at != subscription.created_at ? subscription.updated_at : 'Null'}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        `;

                        modalBody.html(html);
                        $('.view_modal').modal('show');
                    }
                });
            });
        });
    </script>
@endpush

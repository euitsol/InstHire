@extends('admin.layouts.master', ['page_slug' => 'payment'])
@section('title', 'Payment List')
@section('content')
    <!-- Payment List -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <h2 class="card-title mb-4">{{ __('Payment List') }}</h2>
            </div>

            <table id="paymentTable" class="table table-striped table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Institute') }}</th>
                        <th>{{ __('Subscription') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Created At') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->institute->name }}</td>
                            <td>{{ optional(optional($payment->instituteSubscription)->subscription)->title }}</td>
                            <td>{{ $payment->amount }} BDT</td>
                            <td>
                                <span class="{{ $payment->status_badge_color }}">
                                    {{ $payment->status_label }}
                                </span>
                            </td>
                            <td>{{ $payment->created_at->format('d M, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Payment Details Modal  --}}
    @include('admin.includes.details_modal', ['modal_title' => 'Payment Details'])
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
            const table = $('#paymentTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search payments...",
                },
            });
        });
    </script>
@endpush

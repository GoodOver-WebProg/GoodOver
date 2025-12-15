@extends('layout.master')

@section('title', __('status.page_title'))

@push('styles')
<style>
    .status-wrap {
        min-height: 80vh;
        background: #f6f8fb;
    }

    .status-card {
        background: #fff;
        border-radius: 18px;
    }

    .status-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(8, 109, 113, .10);
        color: #086D71;
    }

    .label {
        color: #667085;
        font-size: .9rem;
    }

    .value {
        font-weight: 600;
        color: #101828;
    }
</style>
@endpush

@section('content')
<div class="status-wrap py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <div class="status-card shadow-sm p-4 p-md-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="status-icon">
                            <i class="bi bi-receipt fs-3"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 mb-0">{{ __('status.header.title') }}</div>
                            <div class="text-muted small">{{ __('status.header.subtitle') }}</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div class="text-muted">
                            {{ __('status.order_number') }}:
                            <span class="ms-1 value">{{ $order->order_number ?? '-' }}</span>
                        </div>

                        @php
                        $status = strtolower($order->status ?? 'pending');

                        $badgeClass = 'bg-warning text-dark';
                        $badgeIcon = 'bi-hourglass-split';
                        $badgeText = __('status.status.pending');

                        if ($status === 'finished') {
                        $badgeClass = 'bg-success';
                        $badgeIcon = 'bi-check-circle';
                        $badgeText = __('status.status.finished');
                        } elseif ($status === 'canceled') {
                        $badgeClass = 'bg-danger';
                        $badgeIcon = 'bi-x-circle';
                        $badgeText = __('status.status.canceled');
                        }
                        @endphp

                        <span class="badge {{ $badgeClass }}" style="border-radius:999px;padding:10px 14px;">
                            <i class="bi {{ $badgeIcon }} me-1"></i>
                            {{ $badgeText }}
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded-4 bg-white">
                                <div class="label mb-1">{{ __('status.fields.product') }}</div>
                                <div class="value">{{ $product->name ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded-4 bg-white">
                                <div class="label mb-1">{{ __('status.fields.quantity') }}</div>
                                <div class="value">{{ $item->quantity ?? 0 }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded-4 bg-white">
                                <div class="label mb-1">{{ __('status.fields.total_price') }}</div>
                                <div class="value">
                                    Rp{{ number_format((int)($order->total_price ?? 0), 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded-4 bg-white">
                                <div class="label mb-1">{{ __('status.fields.order_time') }}</div>
                                <div class="value">{{ $orderTime }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 border rounded-4"
                                style="background: rgba(8, 109, 113, .06); border-color: rgba(8, 109, 113, .15) !important;">
                                <div class="label mb-1">
                                    <i class="bi bi-alarm me-1"></i> {{ __('status.fields.pickup_deadline') }}
                                </div>
                                <div class="value">{{ $deadline }}</div>
                                <div class="text-muted small mt-1">
                                    {{ __('status.fields.deadline_hint') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2 flex-wrap">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" style="border-radius:10px;">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('status.actions.back') }}
                        </a>
                        <a href="{{ route('route.profile.history', Auth::id()) }}" class="btn text-white"
                            style="background:#086D71;border-radius:10px;">
                            <i class="bi bi-clock-history me-1"></i> {{ __('status.actions.go_history') }}
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
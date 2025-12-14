@extends('layout.master')

@section('title', __('sellerOrder.title'))

@push('styles')
<style>
    .seller-island {
        background: #fff;
        border-radius: 18px;
    }

    .seller-sidebar {
        min-height: calc(100vh - 120px);
    }

    .table thead th {
        color: #98a2b3;
        font-weight: 600;
        font-size: .85rem;
    }

    .sort-dropdown-container {
        position: relative;
    }

    .sort-dropdown-container .dropdown {
        position: relative;
    }

    .sort-dropdown-container .dropdown-menu {
        border: none;
        box-shadow: 0 4px 12px rgba(8, 109, 113, 0.15);
        border-radius: 12px;
        padding: 8px;
        margin-top: 8px;
        min-width: 240px;
        background: white;
    }

    .sort-dropdown-container .dropdown-toggle {
        background-color: #086D71;
        border: none;
        color: white;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(8, 109, 113, 0.2);
        white-space: nowrap;
    }

    .sort-dropdown-container .dropdown-toggle:hover {
        background-color: #065a5e;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(8, 109, 113, 0.3);
    }

    .sort-dropdown-container .dropdown-toggle:focus {
        background-color: #065a5e;
        box-shadow: 0 0 0 3px rgba(8, 109, 113, 0.25);
    }

    .sort-dropdown-container .dropdown-item {
        border-radius: 8px;
        padding: 10px 16px;
        margin: 2px 0;
        transition: all 0.2s ease;
        color: #333;
        font-size: 0.9rem;
        width: 100%;
        text-align: left;
    }

    .sort-dropdown-container .dropdown-item:hover {
        background-color: #f0f9fa;
        color: #086D71;
        transform: translateX(4px);
    }

    .pagination {
        gap: .35rem;
    }

    .page-link {
        color: #086D71;
        border-radius: 10px;
        border-color: rgba(8, 109, 113, .25);
    }

    .pagination .page-item:first-child .page-link {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .page-link:hover {
        color: #065a5e;
        background-color: rgba(8, 109, 113, .08);
        border-color: rgba(8, 109, 113, .35);
    }

    .page-item.active .page-link {
        background-color: #086D71;
        border-color: #086D71;
        color: #fff;
    }

    .page-item.disabled .page-link {
        color: #9aa4ad;
    }
</style>
@endpush

@section('content')
@php
$filter = request('filter', 'pending'); // pending|finished|all
$sort = request('sort', 'oldest'); // oldest|latest
@endphp

<div class="container-fluid py-4" style="background:#f6f8fb; min-height: 85vh;">
    <div class="row g-4">

        {{-- Sidebar island --}}
        <div class="col-12 col-lg-3">
            <div class="seller-island seller-sidebar p-3 shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width:40px;height:40px;border:1px solid #e5e7eb;">
                        <i class="bi bi-grid"></i>
                    </div>
                    <div class="fw-bold">{{ __('sellerDashboard.sidebar.title') }}</div>
                </div>

                <div class="list-group">
                    <a href="{{ route('seller.dashboard') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-box me-2"></i>{{ __('sellerDashboard.sidebar.product') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="{{ route('seller.product.add.view') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-plus-circle status-2 me-2"></i>{{
                            __('sellerDashboard.sidebar.add_product') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="{{ route('seller.manageOrder') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between active"
                        style="background:#086D71;border-color:#086D71;">
                        <span><i class="bi bi-list-ul status-2 me-2"></i>{{
                            __('sellerDashboard.sidebar.order_management') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <div class="mt-4 pt-4 border-top d-flex align-items-center gap-2">
                    <img src="{{ asset($store->image_path) ?? asset('images/register.jpg') }}" class="rounded-circle"
                        style="width:42px;height:42px;object-fit:cover;">
                    <div>
                        <div class="fw-semibold">{{ $store->name ?? 'Store' }}</div>
                        <div class="text-muted small">{{ Auth::user()->username ?? 'Seller' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main island --}}
        <div class="col-12 col-lg-9">

            {{-- Table island --}}
            <div class="seller-island p-4 shadow-sm">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                    <div>
                        <div class="fw-bold fs-4">{{ __('sellerOrder.header.title') }}</div>
                        <div class="text-muted small">{{ __('sellerOrder.header.subtitle') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-2 flex-wrap">

                        {{-- Filter --}}
                        <div class="sort-dropdown-container">
                            <form action="{{ route('seller.manageOrder') }}" method="GET">
                                <input type="hidden" name="sort" value="{{ $sort }}">

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        @if($filter === 'finished')
                                        {{ __('sellerOrder.filter.finished_only') }}
                                        @elseif($filter === 'pending')
                                        {{ __('sellerOrder.filter.pending_only') }}
                                        @else
                                        {{ __('sellerOrder.filter.all') }}
                                        @endif
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" type="submit" name="filter" value="finished">
                                                <i class="bi bi-check2-circle me-2"></i>{{
                                                __('sellerOrder.filter.finished_only') }}
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="submit" name="filter" value="pending">
                                                <i class="bi bi-hourglass-split me-2"></i>{{
                                                __('sellerOrder.filter.pending_only') }}
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="submit" name="filter" value="all">
                                                <i class="bi bi-clock-history me-2"></i>{{ __('sellerOrder.filter.all')
                                                }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>

                        {{-- Sort --}}
                        <div class="sort-dropdown-container">
                            <form action="{{ route('seller.manageOrder') }}" method="GET">
                                <input type="hidden" name="filter" value="{{ $filter }}">

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $sort === 'latest' ? __('sellerOrder.sort.latest') :
                                        __('sellerOrder.sort.oldest') }}
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="latest">
                                                <i class="bi bi-arrow-down me-2"></i>{{ __('sellerOrder.sort.latest') }}
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="oldest">
                                                <i class="bi bi-arrow-up me-2"></i>{{ __('sellerOrder.sort.oldest') }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="table-responsive pb-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('sellerOrder.table.order_number') }}</th>
                                <th>{{ __('sellerOrder.table.customer_name') }}</th>
                                <th>{{ __('sellerOrder.table.product_name') }}</th>
                                <th>{{ __('sellerOrder.table.product_quantity') }}</th>
                                <th>{{ __('sellerOrder.table.order_date') }}</th>
                                <th>{{ __('sellerOrder.table.order_time') }}</th>
                                <th>{{ __('sellerOrder.table.pickup_deadline') }}</th>
                                <th class="text-end">{{ __('sellerOrder.table.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($orders as $order)
                            @php
                            $item = $order->items->first();
                            $product = $item?->product;

                            $orderDate = $order->created_at?->format('Y-m-d');
                            $orderTime = $order->created_at?->format('H:i');

                            $deadline = ($order->created_at && $product)
                            ? $order->created_at->copy()->addMinutes((int) $product->pickup_duration)->format('H:i')
                            : '-';

                            $modalId = 'finishModal-' . $order->id;

                            // Requirement: when filter=finished, disable the button (even if status is finished anyway)
                            $finishDisabledBecauseFilter = ($filter === 'finished');
                            @endphp

                            <tr>
                                <td class="fw-semibold">{{ $order->order_number ?? '-' }}</td>
                                <td>{{ $order->user->username ?? '-' }}</td>
                                <td>{{ $product->name ?? '-' }}</td>
                                <td>{{ $item->quantity ?? 0 }}</td>
                                <td>{{ $orderDate ?? '-' }}</td>
                                <td>{{ $orderTime ?? '-' }}</td>
                                <td>{{ $deadline }}</td>

                                <td class="text-end">
                                    @if($order->status === 'finished')
                                    <span class="badge bg-success">{{ __('sellerOrder.status.finished') }}</span>
                                    @else
                                    <button type="button" class="btn btn-sm text-white"
                                        style="background:#086D71;border:none;border-radius:10px;"
                                        @if($finishDisabledBecauseFilter) disabled @else data-bs-toggle="modal"
                                        data-bs-target="#{{ $modalId }}" @endif>
                                        {{ __('sellerOrder.action.finish_order') }}
                                    </button>

                                    @if(!$finishDisabledBecauseFilter)
                                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content text-start" style="border-radius:16px;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('sellerOrder.modal.title') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body text-muted">
                                                    {{ __('sellerOrder.modal.body', ['order' => $order->order_number])
                                                    }}
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light border"
                                                        data-bs-dismiss="modal">
                                                        {{ __('sellerOrder.modal.cancel') }}
                                                    </button>

                                                    <form action="{{ route('seller.updateOrder', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn text-white"
                                                            style="background:#086D71;border:none;">
                                                            {{ __('sellerOrder.modal.confirm') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">{{ __('sellerOrder.table.empty') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Toast --}}
                @if (session('success') || session('error'))
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
                    <div id="flashToast"
                        class="toast align-items-center text-bg-{{ session('success') ? 'success' : 'danger' }} border-0"
                        role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('success') ?? session('error') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                            const el = document.getElementById('flashToast');
                            const toast = new bootstrap.Toast(el, { delay: 2500 });
                            toast.show();
                        });
                </script>
                @endif

                <div>
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
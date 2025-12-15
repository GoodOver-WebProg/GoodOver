@extends('layout.master')

@section('title', __('history.title'))

@section('content')
    <div class="container py-5">

        {{-- Header: Judul & Search Bar --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <h3 class="fw-bold m-0">
                <a href="{{ url()->previous() }}" class="text-dark text-decoration-none me-2">
                    <i class="bi bi-chevron-left"></i>
                </a>
                {{ __('history.title') }}
            </h3>

            <div class="d-flex gap-2 w-auto">
                {{-- Search Bar --}}
                <div class="input-group flex-grow-1 flex-md-grow-0" style="max-width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="{{ __('history.search_placeholder') }}">
                </div>

                {{-- Sort Dropdown --}}
                <select class="form-select flex-shrink-0" style="width: auto; min-width: 120px;">
                    <option selected>{{ __('history.newest') }}</option>
                    <option value="1">{{ __('history.oldest') }}</option>
                    <option value="2">{{ __('history.price') }}</option>
                </select>
            </div>
        </div>

        

        {{-- Table Section --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                        <thead class="bg-light border-bottom">
                            <tr class="text-muted text-uppercase d-none d-md-table-row" style="font-size: 0.8rem;">
                                <th class="py-4 ps-4">{{ __('history.product_name') }}</th>
                                <th class="py-4">{{ __('history.price') }}</th>
                                <th class="py-4">{{ __('history.total_quantity') }}</th>
                                <th class="py-4">{{ __('history.date') }}</th>
                                <th class="py-4">{{ __('history.order_time') }}</th>
                                <th class="py-4 text-end pe-4">{{ __('history.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                @php $firstItem = $order->items->first(); @endphp
                                
                                {{-- Desktop View --}}
                                <tr class="d-none d-md-table-row clickable-row" role="button" tabindex="0" data-href="{{ route('order.status', $order->id) }}">
                                    <td class="ps-4 py-3 fw-medium">
                                        {{ $firstItem ? $firstItem->product->name : __('history.item_deleted') }}
                                    </td>
                                    <td class="py-3">
                                        Rp{{ number_format($firstItem ? $firstItem->unit_price : 0, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 text-muted">
                                        {{ $firstItem ? $firstItem->quantity : 0 }} {{ __('history.pcs') }}
                                    </td>
                                    <td class="py-3 text-muted">
                                        {{ $order->created_at->format('d F Y') }}
                                    </td>
                                    <td class="py-3 text-muted">
                                        {{ $order->created_at->format('H.i') }}
                                    </td>
                                    <td class="py-3 text-end pe-4">
                                        @php
                                            $status = strtolower($order->status ?? 'pending');
                                            $badgeClass = 'badge ';
                                            
                                            switch($status) {
                                                case 'pending':
                                                    $badgeClass .= 'bg-warning text-dark';
                                                    $badgeText = __('history.pending');
                                                    break;
                                                case 'finished':
                                                    $badgeClass .= 'bg-success';
                                                    $badgeText = __('history.finished');
                                                    break;
                                                case 'completed':
                                                    $badgeClass .= 'bg-success';
                                                    $badgeText = __('history.completed');
                                                    break;
                                                case 'cancelled':
                                                    $badgeClass .= 'bg-danger';
                                                    $badgeText = __('history.cancelled');
                                                    break;
                                                case 'canceled':
                                                    $badgeClass .= 'bg-danger';
                                                    $badgeText = __('history.canceled');
                                                    break;
                                                default:
                                                    $badgeClass .= 'bg-secondary';
                                                    $badgeText = ucfirst($status);
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }} px-3 py-2">
                                            {{ $badgeText }}
                                        </span>
                                    </td>
                                </tr>

                                {{-- Mobile View --}}
                                <tr class="d-md-none clickable-row" role="button" tabindex="0" data-href="{{ route('order.status', $order->id) }}">
                                    <td class="p-3">
                                        <div class="d-flex flex-column gap-2">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="fw-bold mb-1" style="font-size: 0.95rem;">
                                                        {{ $firstItem ? $firstItem->product->name : __('history.item_deleted') }}
                                                    </div>
                                                    <div class="text-muted small">
                                                        {{ $order->created_at->format('d F Y') }} • {{ $order->created_at->format('H.i') }}
                                                    </div>
                                                </div>
                                                <div>
                                                    @php
                                                        $status = strtolower($order->status ?? 'pending');
                                                        $badgeClass = 'badge ';
                                                        
                                                        switch($status) {
                                                            case 'pending':
                                                                $badgeClass .= 'bg-warning text-dark';
                                                                $badgeText = __('history.pending');
                                                                break;
                                                            case 'finished':
                                                                $badgeClass .= 'bg-success';
                                                                $badgeText = __('history.finished');
                                                                break;
                                                            case 'completed':
                                                                $badgeClass .= 'bg-success';
                                                                $badgeText = __('history.completed');
                                                                break;
                                                            case 'cancelled':
                                                                $badgeClass .= 'bg-danger';
                                                                $badgeText = __('history.cancelled');
                                                                break;
                                                            case 'canceled':
                                                                $badgeClass .= 'bg-danger';
                                                                $badgeText = __('history.canceled');
                                                                break;
                                                            default:
                                                                $badgeClass .= 'bg-secondary';
                                                                $badgeText = ucfirst($status);
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }} px-2 py-1" style="font-size: 0.75rem;">
                                                        {{ $badgeText }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                <div>
                                                    <span class="text-muted small">{{ __('history.price') }}:</span>
                                                    <span class="fw-semibold ms-1">Rp{{ number_format($firstItem ? $firstItem->unit_price : 0, 0, ',', '.') }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-muted small">{{ __('history.total_quantity') }}:</span>
                                                    <span class="fw-semibold ms-1">{{ $firstItem ? $firstItem->quantity : 0 }} {{ __('history.pcs') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        {{ __('history.no_history') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 text-muted gap-3">
            <small class="text-center text-md-start">{{ __('history.showing_page') }} {{ $orders->currentPage() }} {{ __('history.of') }} {{ $orders->lastPage() }}</small>

            {{-- Custom Pagination Links --}}
            <div>
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .clickable-row { cursor: pointer; }
        .table thead th {
            font-weight: 500;
            letter-spacing: 0.5px;
            color: #adb5bd;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .table> :not(caption)>*>* {
            border-bottom-color: #f1f3f5;
        }

        @media (max-width: 767.98px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .table-responsive {
                overflow-x: visible;
            }

            .card {
                border-radius: 12px !important;
            }

            .table td {
                border-bottom: 1px solid #f1f3f5;
            }

            .table td:last-child {
                border-bottom: 2px solid #e9ecef;
            }
        }

        @media (max-width: 575.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            h3 {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('tr.clickable-row[data-href]').forEach((row) => {
            row.addEventListener('click', () => window.location = row.dataset.href);

            row.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') window.location = row.dataset.href;
            });
        });
    });
</script>
@endpush
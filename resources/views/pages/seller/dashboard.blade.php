@extends('layout.master')

@section('title', __('seller_dashboard.title'))

@push('styles')
<style>
    .seller-island {
        background: #fff;
        border-radius: 18px;
    }

    .seller-sidebar {
        min-height: calc(100vh - 120px);
    }

    .stat-pill {
        border-radius: 18px;
    }

    .table thead th {
        color: #98a2b3;
        font-weight: 600;
        font-size: .85rem;
    }

    .sort-dropdown-container {
            position: relative;
            z-index: 1000;
        }

        .sort-dropdown-container .dropdown {
            position: relative;
        }

        .sort-dropdown-container .dropdown-menu {
            z-index: 1000;
            border: none;
            box-shadow: 0 4px 12px rgba(8, 109, 113, 0.15);
            border-radius: 12px;
            padding: 8px;
            margin-top: 8px;
            min-width: 200px;
            background: white;
        }

        .sort-dropdown-container .dropdown-toggle {
            background-color: #086D71;
            border: none;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(8, 109, 113, 0.2);
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
        }

        .sort-dropdown-container .dropdown-item:hover {
            background-color: #f0f9fa;
            color: #086D71;
            transform: translateX(4px);
        }

        .sort-dropdown-container .dropdown-item:active {
            background-color: #086D71;
            color: white;
        }

        .sort-label {
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            margin-right: 12px;
        }

        /* pagination */
        .pagination { gap: .35rem; }
        
        /* Links */
        .page-link{
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
        
        /* Hover */
        .page-link:hover{
        color: #065a5e;
        background-color: rgba(8, 109, 113, .08);
        border-color: rgba(8, 109, 113, .35);
        }
        
        /* Active page */
        .page-item.active .page-link{
        background-color: #086D71;
        border-color: #086D71;
        color: #fff;
        }
        
        /* Disabled */
        .page-item.disabled .page-link{
        color: #9aa4ad;
        }
</style>
@endpush

@section('content')
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
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between active"
                        style="background:#086D71;border-color:#086D71;">
                        <span><i class="bi bi-box me-2"></i>{{ __('sellerDashboard.sidebar.product') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="{{ route('seller.product.add.view') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-plus-circle status-2 me-2"></i>{{ __('sellerDashboard.sidebar.add_product') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href=""
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-list-ul status-2 me-2"></i>{{ __('sellerDashboard.sidebar.order_management') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <div class="mt-4 pt-4 border-top d-flex align-items-center gap-2">
                    <img src="{{ asset($store->image_path) ?? asset('images/register.jpg') }}" class="rounded-circle"
                        style="width:42px;height:42px;object-fit:cover;">
                    <div>
                        <div class="fw-semibold">{{ $store->name ?? 'Store' }}</div>
                        <div class="text-muted small">{{ Auth::user()->username ?? 'Seller'}}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main island --}}
        <div class="col-12 col-lg-9">

            {{-- Stats island --}}
            <div class="seller-island p-3 shadow-sm mb-4">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="p-3 stat-pill d-flex align-items-center justify-content-start" style="background:#f3fff8;">
                            <i class="bi bi-people-fill fs-1 me-3"></i>
                            <div class="d-flex flex-column">
                                <div class="text-muted small">{{ __('sellerDashboard.stats.total_product') }}</div>
                                <div class="fs-3 fw-bold">{{ $totalProduct }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 stat-pill d-flex align-items-center justify-content-start" style="background:#f3fff8;">
                            <i class="bi bi-cash-stack fs-1 me-3"></i>
                            <div class="d-flex flex-column">
                                <div class="text-muted small">{{ __('sellerDashboard.stats.total_sales') }}</div>
                                <div class="fs-3 fw-bold">{{ $totalSales }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 stat-pill d-flex align-items-center justify-content-start" style="background:#f3fff8;">
                            <i class="bi bi-laptop fs-1 me-3"></i>
                            <div class="d-flex flex-column">
                                <div class="text-muted small">{{ __('sellerDashboard.stats.active_product') }}</div>
                                <div class="fs-3 fw-bold">{{ $activeProduct }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table island --}}
            <div class="seller-island p-4 shadow-sm">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                    <div>
                        <div class="fw-bold fs-4">{{ __('sellerDashboard.table.all_products') }}</div>
                        <div class="text-success small">{{ __('sellerDashboard.table.active_products') }}</div>
                    </div>

                    <div class="d-flex align-items-center gap-2">

                        {{-- Search --}}
                        <form action="{{ route('seller.dashboard') }}" method="GET" class="d-flex">
                            <input type="hidden" name="sort" value="{{ request('sort', 'newest') }}">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input 
                                    type="text" 
                                    name="q" 
                                    value="{{ request('q') }}" 
                                    class="form-control border-start-0 rounded-end" 
                                    placeholder="{{ __('sellerDashboard.table.search') }}">
                            </div>
                        </form>

                        {{-- Sort --}}
                        <div class="sort-dropdown-container">
                            <form action="{{ route('seller.dashboard') }}" method="GET">
                                <input type="hidden" name="q" value="{{ request('q') }}">
                                @php $sort = request('sort', 'newest'); @endphp

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $sort === 'price_desc'
                                        ? __('sort.label.price') . ': ' . __('sort.price.descending') 
                                        : ($sort === 'price_asc' ? __('sort.label.price') . ': ' . __('sort.price.ascending') : __('sort.newest')) }}
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="newest">
                                                <i class="bi bi-clock-history me-2"></i>{{ __('sort.newest') }}
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="price_asc">
                                                <i class="bi bi-arrow-up me-2"></i>{{ __('sort.label.price') . ': ' . __('sort.price.ascending') }}
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="submit" name="sort" value="price_desc">
                                                <i class="bi bi-arrow-down me-2"></i>{{ __('sort.label.price') . ': ' . __('sort.price.descending') }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="table-responsive pb-5">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('sellerDashboard.table.product_name') }}</th>
                                <th>{{ __('sellerDashboard.table.price') }}</th>
                                <th>{{ __('sellerDashboard.table.description') }}</th>
                                <th>{{ __('sellerDashboard.table.stock') }}</th>
                                <th>{{ __('sellerDashboard.table.status') }}</th>
                                <th class="text-end">{{ __('sellerDashboard.table.edit') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="text-muted">
                                    {{ \Illuminate\Support\Str::words($product->description ?? '', 3, '...') }}
                                </td>
                                <td>{{ $product->total_quantity }}</td>
                                <td>
                                    @if ($product->status === 'active')
                                    <span class="badge bg-success">{{ __('sellerDashboard.table.active_badge') }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ __('sellerDashboard.table.inactive_badge') }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="dropdown dropstart">
                                        <button class="btn btn-link text-dark p-0" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seller.product.edit.view', $product->id) }}">
                                                    {{ __('sellerDashboard.table.edit_action') }}
                                                </a>
                                            </li>
                                        
                                            <li>
                                                <form action="{{ route('seller.product.delete', $product->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                        
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        {{ __('sellerDashboard.table.delete_action') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">{{ __('sellerDashboard.table.no_products') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (session('success') || session('error'))
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
                    <div id="flashToast"
                        class="toast align-items-center text-bg-{{ session('success') ? 'success' : 'danger' }} border-0" role="alert"
                        aria-live="assertive" aria-atomic="true">
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

                <div class="">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
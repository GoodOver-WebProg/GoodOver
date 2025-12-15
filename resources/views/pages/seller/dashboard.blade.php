@extends('pages.seller.layout.sellerLayout')

@section('sellerContent')
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
@endsection
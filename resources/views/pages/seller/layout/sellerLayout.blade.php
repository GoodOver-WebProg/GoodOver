@extends('layout.master')
@section('title', __('sellerDashboard.title'))

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
        box-shadow: 0 4px 12px rgba(8, 109, 113, .15);
        border-radius: 12px;
        padding: 8px;
        margin-top: 8px;
        min-width: 240px;
        background: #fff;
    }

    .sort-dropdown-container .dropdown-toggle {
        background-color: #086D71;
        border: none;
        color: #fff;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 500;
        font-size: .95rem;
        transition: all .3s ease;
        box-shadow: 0 2px 8px rgba(8, 109, 113, .2);
        white-space: nowrap;
    }

    .sort-dropdown-container .dropdown-toggle:hover {
        background-color: #065a5e;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(8, 109, 113, .3);
    }

    .sort-dropdown-container .dropdown-toggle:focus {
        background-color: #065a5e;
        box-shadow: 0 0 0 3px rgba(8, 109, 113, .25);
    }

    .sort-dropdown-container .dropdown-item {
        border-radius: 8px;
        padding: 10px 16px;
        margin: 2px 0;
        transition: all .2s ease;
        color: #333;
        font-size: .9rem;
        width: 100%;
        text-align: left;
    }

    .sort-dropdown-container .dropdown-item:hover {
        background-color: #f0f9fa;
        color: #086D71;
        transform: translateX(4px);
    }

    .sort-dropdown-container .dropdown-item:active {
        background-color: #086D71;
        color: #fff;
    }

    .sort-label {
        color: #333;
        font-weight: 500;
        font-size: .95rem;
        margin-right: 12px;
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

    .dropzone {
        border: 2px dashed #98a2b3;
        border-radius: 15px;
        height: 350px;
        cursor: pointer;
        background: #fff;
    }

    .dropzone img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
        display: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4" style="background:#f6f8fb; min-height: 85vh;">
    <div class="row g-4">
        {{-- sidebar --}}
        <div class="col-12 col-lg-3">
            <div class="seller-island seller-sidebar p-3 shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width:40px;height:40px;border:1px solid #e5e7eb;">
                        <i class="bi bi-grid"></i>
                    </div>
                    <div class="fw-bold">Dashboard</div>
                </div>

                <div class="list-group">
                    <a  href="{{ route('seller.dashboard') }}" 
                        @class([ 
                            'list-group-item' , 
                            'list-group-item-action', 
                            'd-flex', 
                            'align-items-center', 
                            'justify-content-between', 
                            'active'=> request()->routeIs('seller.dashboard'),
                        ])
                        @style([
                            'background:#086D71;border-color:#086D71;' => request()->routeIs('seller.dashboard'),
                        ])>
                        <span><i class="bi bi-box me-2"></i>Product</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    
                    <a  href="{{ route('seller.product.add.view') }}" 
                        @class([ 
                            'list-group-item', 
                            'list-group-item-action', 
                            'd-flex', 
                            'align-items-center', 
                            'justify-content-between', 
                            'active'=> request()->routeIs('seller.product.add.view'),
                        ])
                        @style([
                            'background:#086D71;border-color:#086D71;' => request()->routeIs('seller.product.add.view'),
                        ])>
                        <span><i class="bi bi-plus-circle me-2"></i>Add Product</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    
                    <a  href="{{ route('seller.manageOrder') }}" 
                        @class([ 
                            'list-group-item', 
                            'list-group-item-action', 
                            'd-flex', 
                            'align-items-center', 
                            'justify-content-between', 
                            'active'=> request()->routeIs('seller.manageOrder'),
                        ])
                        @style([
                            'background:#086D71;border-color:#086D71;' => request()->routeIs('seller.manageOrder'),
                        ])>
                        <span><i class="bi bi-list-ul me-2"></i>Order management</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a  href="{{ route('seller.profile.edit.view') }}" 
                        @class([ 
                            'list-group-item',
                            'list-group-item-action',
                            'd-flex','align-items-center',
                            'justify-content-between', 
                            'active'=> request()->routeIs('seller.profile.edit.view'),
                        ])
                        @style([
                            'background:#086D71;border-color:#086D71;' => request()->routeIs('seller.profile.edit.view'),
                        ])>
                        <span><i class="bi bi-person-circle me-2"></i>{{ __('sellerStoreProfile.title') }}</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <div class="mt-4 pt-4 border-top d-flex align-items-center gap-2">
                    <img src="{{ $store->image_path ? asset($store->image_path) : asset('images/register.jpg') }}"
                        class="rounded-circle" style="width:42px;height:42px;object-fit:cover;">
                    <div>
                        <div class="fw-semibold">{{ $store->name ?? 'Store' }}</div>
                        <div class="text-muted small">{{ Auth::user()->username ?? 'Seller' }}</div>
                        
                    </div>
                </div>
            </div>
        </div>

        @yield('sellerContent')
    </div>
</div>
@endsection
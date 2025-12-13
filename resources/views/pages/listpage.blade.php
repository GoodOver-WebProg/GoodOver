@extends('layout.master')

@section('title', 'ListProduct - GoodOver')

@push('styles')
    <style>
        .product-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
            z-index: 2;
        }

        /* Sort Dropdown Styling - Modern Minimalist */
        .sort-dropdown-container {
            position: relative;
            z-index: 1000;
            margin-bottom: 1.5rem;
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

        /* Filter Header Styling - Clean & Simple */
        .filter-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 3rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }

        .filter-header .filter-icon {
            color: #086D71;
            font-size: 1.3rem;
        }

        .filter-header .filter-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        /* Filter Section Styling */
        .filter-section {
            margin-top: 2rem;
        }

        .filter-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .filter-checkbox {
            margin-top: 0.75rem;
        }

        .filter-checkbox .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 0.25rem;
            cursor: pointer;
            border: 2px solid #086D71;
        }

        .filter-checkbox .form-check-input:checked {
            background-color: #086D71;
            border-color: #086D71;
        }

        .filter-checkbox .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(8, 109, 113, 0.15);
        }

        .filter-checkbox label {
            margin-left: 0.5rem;
            color: #555;
            font-size: 0.95rem;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .filter-checkbox label:hover {
            color: #086D71;
        }

        .filter-submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #086D71 0%, #0a8a90 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 10px;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(8, 109, 113, 0.2);
        }

        .filter-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(8, 109, 113, 0.3);
            background: linear-gradient(135deg, #065a5e 0%, #086D71 100%);
        }
    </style>
@endpush

@section('content')
    <section class='container min-vh-100 position-relative'>
        <div class="row">
            <div class="col col-2 d-flex flex-column align-items-baseline">
                <div class="filter-header">
                    <i class="bi bi-funnel filter-icon"></i>
                    <h3 class="filter-title">
                        Filter
                    </h3>
                </div>
                {{-- Filter --}}
                @php
                    $search = request()->route('search');
                @endphp
                <form action="{{ route('route.product', ['search' => $search]) }}" method="GET">

                    <input type="hidden" name="sort" value="{{ request('sort', 'price_asc') }}">

                    @foreach ($filterHeader as $filterKey => $filter)
                        <div class="filter-section">
                            <h5 class="filter-section-title">{{ $filter['label'] }}</h5>

                            @php $selected = request("filters.$filterKey", []); @endphp

                            @foreach ($filter['options'] as $opt)
                                <div class="filter-checkbox form-check">
                                    <input class="form-check-input" type="checkbox" name="filters[{{ $filterKey }}][]"
                                        value="{{ $opt['value'] }}" @if (in_array($opt['value'], $selected)) checked @endif>
                                    <label class="form-check-label">
                                        {{ $opt['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <button type="submit" class="filter-submit-btn btn text-light">
                        {{ __('filters.submit') }}
                    </button>
                </form>
            </div>
            <div class="col col-10 min-vh-100 ">
                <div class="mt-4 h-100">
                    <div class="px-5 py-4 border border-black rounded-2">
                        <div class="mb-2 d-flex justify-content-end align-items-center">
                            {{-- sort --}}
                            <div class="sort-dropdown-container">
                                <div class="d-flex align-items-center">
                                    <span class="sort-label">{{ __('sort.label.sort') }}:</span>

                                    <form action="{{ route('route.product') }}" method="GET">
                                        @php
                                            $sort = request('sort', 'price_asc');
                                        @endphp

                                        <input type="hidden" name="search" value="{{ $search }}">

                                        @foreach (request('filters', []) as $filterBy => $values)
                                            @foreach ($values as $val)
                                                <input type="hidden" name="filters[{{ $filterBy }}][]"
                                                    value="{{ $val }}">
                                            @endforeach
                                        @endforeach

                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                {{ $sort === 'price_desc'
                                                    ? __('sort.label.price') . ': ' . __('sort.price.descending')
                                                    : __('sort.label.price') . ': ' . __('sort.price.ascending') }}
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item" type="submit" name="sort"
                                                        value="price_asc">
                                                        <i
                                                            class="bi bi-arrow-up me-2"></i>{{ __('sort.label.price') . ': ' . __('sort.price.ascending') }}
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" type="submit" name="sort"
                                                        value="price_desc">
                                                        <i
                                                            class="bi bi-arrow-down me-2"></i>{{ __('sort.label.price') . ': ' . __('sort.price.descending') }}
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                            @foreach ($products as $product)
                                <div class="col">
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="card h-100 border-0 shadow-sm product-card" style="cursor: pointer;">
                                            <div class="card-img-top position-relative"
                                                style="height: 180px; background: linear-gradient(135deg, #FFF9C4 0%, #fff8e1 100%); overflow: hidden;">
                                                <img src="{{ $product->image_path ? asset($product->image_path) : asset('images/burger.jpg') }}"
                                                    class="card-img-top object-fit-cover"
                                                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                                    alt="{{ $product->name }}"
                                                    onerror="this.onerror=null; this.src='{{ asset('images/burger.jpg') }}';"
                                                    onmouseover="this.style.transform='scale(1.1)'"
                                                    onmouseout="this.style.transform='scale(1)'">
                                            </div>

                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-1 text-truncate">
                                                    {{ $product->name }}
                                                </h6>

                                                <p class="mb-1 fw-semibold text-success">
                                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                                </p>

                                                <p class="mb-0 small text-muted">
                                                    Stock: {{ $product->total_quantity }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                        <div class="col">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="{{ asset('images/burger.jpg') }}" class="card-img-top object-fit-cover"
                                        style="height: 180px;" alt="Product Name">

                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-1 text-truncate">
                                            Placeholder Product Name
                                        </h6>

                                        <p class="mb-1 fw-semibold text-success">
                                            Rp10.000
                                        </p>

                                        <p class="mb-0 small text-muted text-truncate">
                                            Placeholder Store Name
                                        </p>

                                        <p class="mb-0 small text-muted">
                                            Stock: 99
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layout.master')

@section('title', __('home.title'))

@push('styles')
    <style>
        .section-divider {
            position: relative;
            overflow: hidden;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
            pointer-events: none;
        }

        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #086D71, #FFF9C4);
            border-radius: 2px;
        }

        .step-number {
            position: absolute;
            top: -15px;
            right: -15px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #086D71, #0a8a90);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 8px rgba(8, 109, 113, 0.3);
        }

        .step-card {
            position: relative;
            background: white;
            border-radius: 20px;
            transition: all 0.3s ease;
            overflow: visible;
        }

        .step-card:hover {
            transform: translateY(-10px);
        }

        .product-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        .hero-section {
            min-height: 600px;
            padding: 100px 0 80px 0;
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            line-height: 1.6;
        }

        .hero-button {
            font-size: 1.1rem;
            padding: 1rem 2.5rem;
        }

        @media (max-width: 991.98px) {
            .hero-section {
                min-height: 550px;
                padding: 90px 0 70px 0;
            }

            .hero-title {
                font-size: 2.8rem;
                line-height: 1.3;
            }

            .hero-subtitle {
                font-size: 1.15rem;
                line-height: 1.5;
            }

            .hero-button {
                font-size: 1rem;
                padding: 0.9rem 2.2rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                min-height: auto;
                padding: 100px 0 80px 0;
            }

            .hero-title {
                font-size: 2rem;
                line-height: 1.3;
                margin-bottom: 1rem !important;
            }

            .hero-subtitle {
                font-size: 1rem;
                line-height: 1.5;
                margin-bottom: 1.5rem !important;
            }

            .hero-button {
                font-size: 0.95rem;
                padding: 0.75rem 2rem;
                display: inline-block;
                width: auto;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-section {
                padding: 90px 0 70px 0;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .hero-subtitle {
                font-size: 0.95rem;
            }

            .hero-button {
                font-size: 0.9rem;
                padding: 0.7rem 1.8rem;
            }
        }
    </style>
@endpush

@section('content')
    {{-- Flash Messages --}}
    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- Hero Section --}}
    <section class="position-relative hero-section"
        style="background-image: url('{{ asset('images/homepages.jpg') }}'); background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.3);">
        </div>
        <div class="container position-relative h-100 d-flex align-items-center">
            <div class="row w-100">
                <div class="col-lg-7 col-md-9 col-12">
                    <h1 class="text-white fw-bold mb-4 hero-title" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.3);">
                        {{ __('home.hero_title') }}
                    </h1>
                    <p class="text-white mb-4 hero-subtitle" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.3);">
                        {{ __('home.hero_subtitle') }}
                    </p>
                    <a href="#foods" class="btn text-white fw-bold hero-button"
                        style="background: linear-gradient(135deg, #086D71, #0a8a90); border-radius: 12px; box-shadow: 0 4px 15px rgba(8, 109, 113, 0.4); transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(8, 109, 113, 0.5)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(8, 109, 113, 0.4)'">
                        {{ __('home.explore_foods') }} <i class="bi bi-arrow-down ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        {{-- Smooth transition to next section --}}
        <div class="section-divider"></div>
    </section>

    {{-- Latest Products Section --}}
    <section id="foods" class="py-5 position-relative"
        style="background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%); margin-top: -50px; padding-top: 80px !important;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold mb-3" style="font-size: 2.8rem; color: #333;">
                    @if (request('q'))
                        {{ __('home.search_results') }}
                    @else
                        {{ __('home.latest_products') }}
                    @endif
                </h2>
                @if (request('q'))
                    <p class="text-muted" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                        {{ __('home.search_results') }}: "{{ request('q') }}"
                    </p>
                @else
                    <p class="text-muted" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                        {{ __('home.explore_todays_highlights') }}
                    </p>
                @endif
            </div>
            @php
                $displayProducts = $isSearch ? $products : $latestProducts;
            @endphp

            @if ($isSearch && $products && $products->count() > 0)
                {{-- Search Results Grid: Mobile 1 col, Tablet 2 cols, Desktop 4 cols --}}
                <div class="row g-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 border-0 shadow product-card" style="cursor: pointer;">
                                    <div class="card-img-top position-relative"
                                        style="height: 220px; background: linear-gradient(135deg, #FFF9C4 0%, #fff8e1 100%); overflow: hidden;">
                                        @if ($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                class="img-fluid"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                                onerror="this.onerror=null; this.src='{{ asset('images/products/burger.jpg') }}'; this.style.display='block'; this.parentElement.querySelector('.fallback-placeholder').style.display='none';"
                                                onmouseover="this.style.transform='scale(1.1)'"
                                                onmouseout="this.style.transform='scale(1)'">
                                            <div
                                                class="fallback-placeholder d-none d-flex align-items-center justify-content-center h-100 position-absolute top-0 start-0 w-100">
                                                <i class="bi bi-image" style="font-size: 3rem; color: #086D71;"></i>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class="bi bi-image" style="font-size: 3rem; color: #086D71;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body text-center p-4" style="background: white;">
                                        <h5 class="card-title mb-2 fw-bold" style="color: #333; font-size: 1.1rem;">
                                            {{ $product->name }}
                                        </h5>
                                        <p class="card-text text-muted mb-2"
                                            style="font-size: 0.9rem; min-height: 40px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            {{ Str::limit($product->description ?? '', 60) }}
                                        </p>
                                        <p class="card-text fw-bold mb-2" style="color: #086D71; font-size: 1.2rem;">
                                            Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                        </p>
                                        <p class="card-text mb-0" style="font-size: 0.85rem; color: #28a745;">
                                            <i class="bi bi-check-circle me-1"></i>{{ __('home.in_stock') }}:
                                            {{ $product->total_quantity ?? 0 }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{-- Pagination for search results --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @elseif(!$isSearch && $latestProducts->count() > 0)
                {{-- Latest Products Grid: Mobile 1 col, Tablet 2 cols, Desktop 4 cols --}}
                <div class="row g-4">
                    @foreach ($latestProducts as $product)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                            <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                                <div class="card h-100 border-0 shadow product-card" style="cursor: pointer;">
                                    <div class="card-img-top position-relative"
                                        style="height: 220px; background: linear-gradient(135deg, #FFF9C4 0%, #fff8e1 100%); overflow: hidden;">
                                        @if ($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                class="img-fluid"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                                onerror="this.onerror=null; this.src='{{ asset('images/products/burger.jpg') }}'; this.style.display='block'; this.parentElement.querySelector('.fallback-placeholder').style.display='none';"
                                                onmouseover="this.style.transform='scale(1.1)'"
                                                onmouseout="this.style.transform='scale(1)'">
                                            <div
                                                class="fallback-placeholder d-none d-flex align-items-center justify-content-center h-100 position-absolute top-0 start-0 w-100">
                                                <i class="bi bi-image" style="font-size: 3rem; color: #086D71;"></i>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class="bi bi-image" style="font-size: 3rem; color: #086D71;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body text-center p-4" style="background: white;">
                                        <h5 class="card-title mb-2 fw-bold" style="color: #333; font-size: 1.1rem;">
                                            {{ $product->name }}
                                        </h5>
                                        <p class="card-text text-muted mb-2"
                                            style="font-size: 0.9rem; min-height: 40px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            {{ Str::limit($product->description ?? '', 60) }}
                                        </p>
                                        <p class="card-text fw-bold mb-2" style="color: #086D71; font-size: 1.2rem;">
                                            Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                        </p>
                                        <p class="card-text mb-0" style="font-size: 0.85rem; color: #28a745;">
                                            <i class="bi bi-check-circle me-1"></i>{{ __('home.in_stock') }}:
                                            {{ $product->total_quantity ?? 0 }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- See More Button --}}
                @if ($totalProducts > 8)
                    <div class="mt-4 d-flex justify-content-center">
                        <a href="{{ route('route.product') }}" class="btn text-white fw-bold px-5 py-3"
                            style="background: linear-gradient(135deg, #086D71, #0a8a90); border-radius: 12px; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(8, 109, 113, 0.4); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(8, 109, 113, 0.5)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(8, 109, 113, 0.4)'">
                            {{ __('home.see_more') }} <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <p class="text-muted" style="font-size: 1.2rem;">{{ __('home.no_products') }}</p>
                </div>
            @endif
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-5 position-relative" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold mb-3" style="font-size: 2.8rem; color: #333;">
                    {{ __('home.how_it_works') }}</h2>
                <p class="text-muted" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Get started in three simple steps and start saving money while reducing food waste
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                {{-- Step 1 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow step-card" style="cursor: default;">
                        <span class="step-number">1</span>
                        <div class="card-body text-center p-5">
                            <div class="mb-4 d-flex justify-content-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #FFF9C4, #fff8e1); box-shadow: 0 4px 15px rgba(255, 249, 196, 0.5);">
                                    <i class="bi bi-search" style="font-size: 3rem; color: #086D71;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.5rem;">{{ __('home.find_food') }}
                            </h4>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1rem;">
                                {{ __('home.find_food_desc') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow step-card" style="cursor: default;">
                        <span class="step-number">2</span>
                        <div class="card-body text-center p-5">
                            <div class="mb-4 d-flex justify-content-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #FFF9C4, #fff8e1); box-shadow: 0 4px 15px rgba(255, 249, 196, 0.5);">
                                    <i class="bi bi-cart-check" style="font-size: 3rem; color: #086D71;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.5rem;">
                                {{ __('home.reserve_easily') }}</h4>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1rem;">
                                {{ __('home.reserve_easily_desc') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow step-card" style="cursor: default;">
                        <span class="step-number">3</span>
                        <div class="card-body text-center p-5">
                            <div class="mb-4 d-flex justify-content-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #FFF9C4, #fff8e1); box-shadow: 0 4px 15px rgba(255, 249, 196, 0.5);">
                                    <i class="bi bi-bag-check" style="font-size: 3rem; color: #086D71;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.5rem;">
                                {{ __('home.pickup_enjoy') }}</h4>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1rem;">
                                {{ __('home.pickup_enjoy_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

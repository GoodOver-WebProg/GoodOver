@extends('layout.master')

@section('title', 'Home - GoodOver')

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
    </style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="position-relative"
        style="min-height: 550px; background-image: url('{{ asset('images/homepages.jpg') }}'); background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.3);">
        </div>
        <div class="container position-relative" style="min-height: 550px; display: flex; align-items: center;">
            <div class="row w-100">
                <div class="col-lg-7">
                    <h1 class="text-white fw-bold mb-4"
                        style="font-size: 3.5rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); line-height: 1.2;">
                        Save Food, Save Money.
                    </h1>
                    <p class="text-white mb-4"
                        style="font-size: 1.3rem; text-shadow: 1px 1px 4px rgba(0,0,0,0.3); line-height: 1.6;">
                        Join our mission to reduce food waste and save money.
                    </p>
                    <a href="#foods" class="btn text-white fw-bold px-5 py-3"
                        style="background: linear-gradient(135deg, #086D71, #0a8a90); border-radius: 12px; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(8, 109, 113, 0.4); transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(8, 109, 113, 0.5)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(8, 109, 113, 0.4)'">
                        Explore Foods <i class="bi bi-arrow-down ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        {{-- Smooth transition to next section --}}
        <div class="section-divider"></div>
    </section>

    {{-- Best Sellers Section --}}
    <section id="foods" class="py-5 position-relative"
        style="background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%); margin-top: -50px; padding-top: 80px !important;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold mb-3" style="font-size: 2.8rem; color: #333;">Best Sellers</h2>
                <p class="text-muted" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Discover our most popular food items, carefully selected for quality and freshness
                </p>
            </div>
            <div class="row g-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('food.detail', ['id' => $i + 1]) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 border-0 shadow product-card" style="cursor: pointer;">
                                <div class="card-img-top position-relative"
                                    style="height: 220px; background: linear-gradient(135deg, #FFF9C4 0%, #fff8e1 100%); overflow: hidden;">
                                    <img src="{{ asset('images/burger.jpg') }}" alt="Food" class="img-fluid"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="card-body text-center p-4" style="background: white;">
                                    <h5 class="card-title mb-2 fw-bold" style="color: #333; font-size: 1.1rem;">Organic
                                        Tomatoes</h5>
                                    <p class="card-text fw-bold mb-0" style="color: #086D71; font-size: 1.2rem;">Rp 0</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-5 position-relative" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold mb-3" style="font-size: 2.8rem; color: #333;">How It Works?</h2>
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
                            <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.5rem;">Find Food</h4>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1rem;">
                                Explore affordable or free food near you.
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
                            <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.5rem;">Reserve Easily</h4>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1rem;">
                                Reserve your favorite food in just one click.
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
                            <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.5rem;">Pick Up & Enjoy</h4>
                            <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1rem;">
                                Collect your food before the time runs out and enjoy your meal.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

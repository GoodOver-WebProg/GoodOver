@extends('layout.master')

@section('title', __('product.title'))

@section('content')
    {{-- Banner Section --}}
    <section class="position-relative"
        style="min-height: 300px; background-image: url('{{ asset('images/details.jpg') }}'); background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="container position-relative"
            style="min-height: 300px; display: flex; align-items: center; justify-content: center;">
            <div class="text-center text-white">
                <h1 class="mb-2" style="font-size: 2.5rem;">GoodOver</h1>
                <p class="mb-0" style="font-size: 1.2rem;">{{ __('product.title') }}</p>
            </div>
        </div>
    </section>

    {{-- Product Details Section --}}
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row g-4">
                {{-- Product Image --}}
                <div class="col-md-6">
                    <div class="mb-4">
                        <div class="card border-0 shadow-sm"
                            style="border-radius: 16px; overflow: hidden; position: relative; width: 100%; padding-bottom: 100%;">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='{{ asset('images/burger.jpg') }}'; this.style.display='block'; this.parentElement.querySelector('.fallback-placeholder').style.display='none';">
                                <div class="fallback-placeholder d-none d-flex align-items-center justify-content-center h-100"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, #FFF9C4, #fff8e1);">
                                    <i class="bi bi-image" style="font-size: 5rem; color: #086D71;"></i>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, #FFF9C4, #fff8e1);">
                                    <i class="bi bi-image" style="font-size: 5rem; color: #086D71;"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quantity Selector --}}
                    <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; background-color: #f8f9fa;">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-semibold" style="color: #333;">{{ __('product.quantity') }}:</span>
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn"
                                    style="background-color: #086D71; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"
                                    onclick="decreaseQuantity()">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span id="quantity" class="fw-bold"
                                    style="font-size: 1.2rem; color: #086D71; min-width: 30px; text-align: center;">1</span>
                                <button class="btn"
                                    style="background-color: #086D71; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"
                                    onclick="increaseQuantity()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product Info --}}
                <div class="col-md-6">
                    @if ($product->status === 'best_seller' || $product->status === 'active')
                        <div class="mb-3">
                            <span class="badge rounded-pill px-3 py-2"
                                style="background-color: #FFF9C4; color: #333; font-size: 0.9rem;">
                                <i class="bi bi-fire me-1"></i> {{ __('product.best_seller') }}
                            </span>
                        </div>
                    @endif

                    <h2 class="fw-bold mb-3" style="font-size: 2rem; color: #333;">{{ $product->name }}</h2>

                    {{-- Price --}}
                    <div class="mb-4">
                        <p class="fw-bold mb-1" style="font-size: 2rem; color: #086D71;">
                            Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                        </p>
                        @if ($product->price == 0)
                            <small class="text-muted">Free - Limited time offer</small>
                        @endif
                    </div>

                    {{-- Info Cards --}}
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="card border-0 shadow-sm h-100"
                                style="border-radius: 12px; background-color: #f8f9fa;">
                                <div class="card-body p-3 text-center">
                                    <i class="bi bi-box-seam text-primary" style="font-size: 1.5rem;"></i>
                                    <p class="mb-0 mt-2 small fw-semibold" style="color: #333;">
                                        {{ __('product.available_quantity') }}</p>
                                    <p class="mb-0 mt-1 fw-bold" style="color: #086D71; font-size: 1.1rem;">
                                        {{ $product->total_quantity ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($product->pickup_duration || $product->pickup_duration)
                            <div class="col-6">
                                <div class="card border-0 shadow-sm h-100"
                                    style="border-radius: 12px; background-color: #f8f9fa;">
                                    <div class="card-body p-3 text-center">
                                        <i class="bi bi-clock text-primary" style="font-size: 1.5rem;"></i>
                                        <p class="mb-0 mt-2 small fw-semibold" style="color: #333;">
                                            {{ __('product.pickup_duration') }}</p>
                                        <p class="mb-0 mt-1 fw-bold" style="color: #086D71; font-size: 1.1rem;">
                                            {{ $product->pickup_duration ?? ($product->pickup_duration ?? 'N/A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-6">
                            <div class="card border-0 shadow-sm h-100"
                                style="border-radius: 12px; background-color: #f8f9fa;">
                                <div class="card-body p-3 text-center">
                                    <i class="bi bi-shield-check text-success" style="font-size: 1.5rem;"></i>
                                    <p class="mb-0 mt-2 small fw-semibold" style="color: #333;">
                                        {{ __('product.fresh_safe') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    @if ($product->description)
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; background-color: #f8f9fa;">
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-2" style="color: #333;">{{ __('product.description') }}</h6>
                                <p class="mb-0" style="color: #666; line-height: 1.6; font-size: 0.95rem;">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Reserve Button --}}
                    <div class="d-grid">
                        @auth
                            <button class="btn text-white fw-bold py-3"
                                style="background-color: #086D71; border-radius: 12px; font-size: 1.1rem; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#065a5e'; this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.backgroundColor='#086D71'; this.style.transform='translateY(0)'">
                                <i class="bi bi-cart-plus me-2"></i> {{ __('product.reserve_now') }}
                            </button>
                        @endauth
                        @guest
                            <a href="{{ route('route.login.view') }}" class="btn text-white fw-bold py-3"
                                style="background-color: #086D71; border-radius: 12px; font-size: 1.1rem; transition: all 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#065a5e'; this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.backgroundColor='#086D71'; this.style.transform='translateY(0)'">
                                <i class="bi bi-box-arrow-in-right me-2"></i> {{ __('product.login_to_continue') }}
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            let quantity = 1;

            function increaseQuantity() {
                quantity++;
                document.getElementById('quantity').textContent = quantity;
            }

            function decreaseQuantity() {
                if (quantity > 1) {
                    quantity--;
                    document.getElementById('quantity').textContent = quantity;
                }
            }
        </script>
    @endpush
@endsection

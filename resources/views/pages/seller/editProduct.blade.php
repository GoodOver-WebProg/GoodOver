@extends('layout.master')

@push('styles')
<style>
    .seller-island {
        background: #fff;
        border-radius: 18px;
    }

    .seller-sidebar {
        min-height: calc(100vh - 120px);
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

        {{-- Sidebar --}}
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
                    <a href="{{ route('seller.dashboard') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-box me-2"></i>Product</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href="{{ route('seller.product.add.view') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-plus-circle me-2"></i>Add Product</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a href=""
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                        <span><i class="bi bi-list-ul me-2"></i>Order management</span>
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

        {{-- Main --}}
        <div class="col-12 col-lg-9">
            <div class="seller-island p-4 shadow-sm" style="background:#f1f1f1;border-radius:20px;">

                {{-- Header --}}
                <div class="mb-4">
                    <h4 class="mb-0 fw-bold">{{ __('sellerProduct.title_add') }}</h4>
                </div>

                <form action="{{ route('seller.product.edit', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        {{-- LEFT: all fields --}}
                        <div class="col-12 col-md-8">

                            <div class="form-group mb-2">
                                <label class="fw-semibold mb-1">{{ __('sellerProduct.name_label') }}</label>
                                <input type="text" name="name"
                                    class="form-control mb-1 @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="mb-1">{{ __('sellerProduct.price_label') }}</label>
                                        <input type="number" name="price"
                                            class="form-control mb-1 @error('price') is-invalid @enderror"
                                            value="{{ old('price', $product->price) }}" min="0" required>
                                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label class="fw-semibold mb-1">{{ __('sellerProduct.description_label') }}</label>
                                <textarea name="description"
                                    class="form-control mb-1 @error('description') is-invalid @enderror" rows="5"
                                    required>{{ old('description', $product->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="fw-semibold mb-2">{{ __('sellerProduct.status_label') }}</label>

                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input @error('status') is-invalid @enderror"
                                            type="radio" name="status" value="active" id="statusActive" {{ old('status', $product->status) === 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusActive">
                                            {{ __('sellerProduct.status_active') }}
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input @error('status') is-invalid @enderror"
                                            type="radio" name="status" value="inactive" id="statusInactive" {{ old('status', $product->status) === 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusInactive">
                                            {{ __('sellerProduct.status_inactive') }}
                                        </label>
                                    </div>
                                </div>

                                @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="fw-semibold mb-1">{{ __('sellerProduct.category_label') }}</label>
                                <select name="category_id"
                                    class="form-select mb-1 @error('category_id') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('category_id', $product->category_id) ? '' : 'selected' }}>
                                        {{ __('sellerProduct.category_placeholder') }}
                                    </option>
                                    
                                    @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (string)old('category_id', $product->category_id) === (string)$cat->id ? 'selected' :
                                        '' }}>
                                        {{ $cat->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold mb-1">{{
                                            __('sellerProduct.pickup_duration_label') }}</label>
                                        <input type="number" name="pickup_duration"
                                            class="form-control mb-1 @error('pickup_duration') is-invalid @enderror"
                                            value="{{ old('pickup_duration', $product->pickup_duration) }}" min="1" required>
                                        @error('pickup_duration') <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="fw-semibold mb-1">{{ __('sellerProduct.total_quantity_label')
                                            }}</label>
                                        <input type="number" name="total_quantity"
                                            class="form-control mb-1 @error('total_quantity') is-invalid @enderror"
                                            value="{{ old('total_quantity', $product->total_quantity) }}" min="0" required>
                                        @error('total_quantity') <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-dark px-4">
                                {{ __('sellerProduct.submit_button') }}
                            </button>
                        </div>

                        {{-- RIGHT: image upload --}}
                        <div class="col-12 col-md-4">
                            <input type="file" name="image_path" id="imageInput" class="d-none" accept=".jpg,.jpeg,.png">
                            
                            <div class="dropzone d-flex justify-content-center align-items-center p-3 @error('image_path') border-danger @enderror"
                                id="dropzone">
                                <img id="imagePreview" alt="Preview" src="{{ $product->image_path ? asset($product->image_path) : '' }}"
                                    style="{{ $product->image_path ? 'display:block;' : 'display:none;' }}">
                            
                                <div class="text-center" id="dropzonePlaceholder" style="{{ $product->image_path ? 'display:none;' : '' }}">
                                    <i class="bi bi-upload" style="font-size:45px;"></i>
                                    <p class="mt-2 fw-semibold">{{ __('sellerProduct.image_placeholder') }}</p>
                                    <small class="text-muted">{{ __('sellerProduct.image_hint') }}</small>
                                </div>
                            </div>

                            @error('image_path')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    const input = document.getElementById('imageInput');
    const dropzone = document.getElementById('dropzone');
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('dropzonePlaceholder');

    dropzone.addEventListener('click', () => input.click());

    input.addEventListener('change', () => {
        const file = input.files && input.files[0];
        if (!file) return;

        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
    });
</script>
@endpush
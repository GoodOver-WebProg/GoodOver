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

    .step-pill {
        border-radius: 999px;
        padding: 8px 14px;
        font-weight: 600;
        font-size: .9rem;
        border: 1px solid #e5e7eb;
        color: #667085;
        background: #fff;
    }

    .step-pill.active {
        border-color: #086D71;
        color: #086D71;
        background: rgba(8, 109, 113, .06);
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
                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between active"
                        style="background:#086D71;border-color:#086D71;">
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

                {{-- Step header (no border) --}}
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div id="stepPill1" class="step-pill active">Step 1</div>
                    <div id="stepPill2" class="step-pill">Step 2</div>
                </div>

                <form action="{{ route('seller.product.add') }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf

                    <div class="row g-4">
                        {{-- LEFT --}}
                        <div class="col-12 col-md-8">

                            {{-- Step 1 --}}
                            <div id="step1">
                                <div class="form-group mb-2">
                                    <label class="fw-semibold mb-1">
                                        <span class="text-danger">*</span> Insert Food Name
                                    </label>
                                    <input type="text" name="name" class="form-control mb-1 @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="mb-1">Insert Food Price</label>
                                            <input type="number" name="price" class="form-control mb-1 @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}" min="0" required>
                                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-group mb-2">
                                    <label class="fw-semibold mb-1">
                                        <span class="text-danger">*</span> Insert Food Description
                                    </label>
                                    <textarea name="description" class="form-control mb-1 @error('description') is-invalid @enderror" rows="5"
                                        required>{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            
                                <button type="button" class="btn btn-outline-dark px-4" id="btnNext">
                                    Next
                                </button>
                            </div>

                            {{-- Step 2 --}}
                            <div id="step2" style="display:none;">
                                <div class="form-group mb-2">
                                    <label class="fw-semibold mb-2">Status</label>
                            
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                                                value="active" id="statusActive" {{ old('status','active')==='active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusActive">Active</label>
                                        </div>
                            
                                        <div class="form-check">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status"
                                                value="inactive" id="statusInactive" {{ old('status')==='inactive' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="statusInactive">Inactive</label>
                                        </div>
                                    </div>
                            
                                    @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            
                                <div class="form-group mb-2">
                                    <label class="fw-semibold mb-1">Category</label>
                                    <select name="category_id" class="form-select mb-1 @error('category_id') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Choose...</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ (string)old('category_id')===(string)$cat->id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold mb-1">Pickup duration (minutes)</label>
                                            <input type="number" name="pickup_duration"
                                                class="form-control mb-1 @error('pickup_duration') is-invalid @enderror"
                                                value="{{ old('pickup_duration') }}" min="1" required>
                                            @error('pickup_duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="fw-semibold mb-1">Total quantity</label>
                                            <input type="number" name="total_quantity"
                                                class="form-control mb-1 @error('total_quantity') is-invalid @enderror"
                                                value="{{ old('total_quantity') }}" min="0" required>
                                            @error('total_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-secondary px-4" id="btnBack">Back</button>
                                    <button type="submit" class="btn btn-outline-dark px-4">Submit</button>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT: image upload (Step 1) --}}
                        <div class="col-12 col-md-4">
                            <input type="file" name="image_path" id="imageInput" class="d-none" accept=".jpg,.jpeg,.png">
                            
                            <div class="dropzone d-flex justify-content-center align-items-center p-3 @error('image_path') border-danger @enderror"
                                id="dropzone">
                                <img id="imagePreview" alt="Preview">
                                <div class="text-center" id="dropzonePlaceholder">
                                    <i class="bi bi-upload" style="font-size:45px;"></i>
                                    <p class="mt-2 fw-semibold">Drop Image Here</p>
                                    <small class="text-muted">JPG / JPEG / PNG</small>
                                </div>
                            </div>
                            
                            @error('image_path') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
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
    // step switch
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const pill1 = document.getElementById('stepPill1');
    const pill2 = document.getElementById('stepPill2');

    document.getElementById('btnNext').addEventListener('click', () => {
        step1.style.display = 'none';
        step2.style.display = 'block';
        pill1.classList.remove('active');
        pill2.classList.add('active');
    });

    document.getElementById('btnBack').addEventListener('click', () => {
        step2.style.display = 'none';
        step1.style.display = 'block';
        pill2.classList.remove('active');
        pill1.classList.add('active');
    });

    // image click + preview
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
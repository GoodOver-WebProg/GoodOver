@extends('pages.seller.layout.sellerLayout')

@section('sellerContent')
<div class="col-12 col-lg-9">
    <div class="seller-island p-4 shadow-sm" style="background:#f1f1f1;border-radius:20px;">

        <div class="mb-4">
            <h4 class="mb-0 fw-bold">{{ __('sellerStoreProfile.title') }}</h4>
        </div>

        <form action="{{ route('seller.profile.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- LEFT --}}
                <div class="col-12 col-md-8">

                    <div class="form-group mb-2">
                        <label class="fw-semibold mb-1">{{ __('sellerStoreProfile.store_name') }}</label>
                        <input type="text" name="name" class="form-control mb-1 @error('name') is-invalid @enderror"
                            value="{{ old('name', $store->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label class="fw-semibold mb-1">{{ __('sellerStoreProfile.contact') }}</label>
                        <input type="text" name="contact"
                            class="form-control mb-1 @error('contact') is-invalid @enderror"
                            value="{{ old('contact', $store->contact) }}" required>
                        @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Time range: opening - closing --}}
                    <div class="form-group mb-2">
                        <label class="fw-semibold mb-1">{{ __('sellerStoreProfile.opening_time') }}</label>

                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <input type="time" name="opening_time"
                                class="form-control mb-1 @error('opening_time') is-invalid @enderror"
                                value="{{ old('opening_time', $store->opening_time) }}" step="60" required>

                            <div class="text-muted small">{{ __('sellerStoreProfile.until') }}</div>

                            <input type="time" name="closing_time"
                                class="form-control mb-1 @error('closing_time') is-invalid @enderror"
                                value="{{ old('closing_time', $store->closing_time) }}" step="60" required>
                        </div>

                        @error('opening_time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        @error('closing_time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label class="fw-semibold mb-1">{{ __('sellerStoreProfile.address') }}</label>
                        <textarea name="address" class="form-control mb-1 @error('address') is-invalid @enderror"
                            rows="4" required>{{ old('address', $store->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold mb-1">{{ __('sellerStoreProfile.location') }}</label>
                    
                        <select name="location" class="form-select mb-1 @error('location') is-invalid @enderror" required>
                    
                            <option value="" disabled {{ old('location', $store->location) ? '' : 'selected' }}>
                                {{ __('sellerStoreProfile.location_placeholder') }}
                            </option>
                    
                            @foreach (['Jakarta Utara','Jakarta Barat','Jakarta Timur','Jakarta Selatan','Jakarta Pusat'] as $loc)
                            <option value="{{ $loc }}" {{ old('location', $store->location) === $loc ? 'selected' : '' }}>
                                {{ $loc }}
                            </option>
                            @endforeach
                        </select>
                    
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                {{-- RIGHT: image upload --}}
                <div class="col-12 col-md-4">
                    <input type="file" name="image_path" id="imageInput" class="d-none" accept=".jpg,.jpeg,.png">

                    <div class="dropzone d-flex justify-content-center align-items-center p-3 @error('image_path') border-danger @enderror"
                        id="dropzone">

                        <img id="imagePreview" alt="Preview"
                            src="{{ $store->image_path ? asset($store->image_path) : '' }}"
                            style="{{ $store->image_path ? 'display:block;' : 'display:none;' }}">

                        <div class="text-center" id="dropzonePlaceholder"
                            style="{{ $store->image_path ? 'display:none;' : '' }}">
                            <i class="bi bi-upload" style="font-size:45px;"></i>
                            <p class="mt-2 fw-semibold">{{ __('sellerStoreProfile.image_placeholder') }}</p>
                            <small class="text-muted">{{ __('sellerStoreProfile.image_hint') }}</small>
                        </div>
                    </div>

                    @error('image_path')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-4">
                    <button type="submit" class="btn btn-outline-dark px-4">
                        {{ __('sellerProduct.submit_button') }}
                    </button>
                </div>
            </div>
        </form>
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
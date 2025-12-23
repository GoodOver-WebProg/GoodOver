    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Register</title>
        @include('layout.bootstrap')

        <style>
            .step {
                display: none;
            }

            .step.active {
                display: block;
            }
            @media (max-width: 767.98px) {
            .back-to-goodover-btn {
            margin: 0.75rem !important;
            }
            
            .back-to-goodover-btn a {
            padding: 6px 12px !important;
            font-size: 0.85rem !important;
            }
            
            .back-to-goodover-btn .back-text {
            display: none;
            }
            
            .back-to-goodover-btn i {
            margin-right: 0 !important;
            font-size: 1.1rem !important;
            }
            }
            
            @media (min-width: 768px) and (max-width: 991.98px) {
            .back-to-goodover-btn .back-text {
            font-size: 0.85rem;
            }
            }
        </style>
    </head>
    <body>
        <div class="position-fixed top-0 start-0 m-3 back-to-goodover-btn" style="z-index: 1050;">
            <a href="{{ route('home') }}" class="btn btn-sm d-flex align-items-center text-decoration-none"
                style="background-color: #086D71; color: white; border-radius: 8px; padding: 8px 16px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(8, 109, 113, 0.3);"
                onmouseover="this.style.backgroundColor='#065a5e'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(8, 109, 113, 0.4)'"
                onmouseout="this.style.backgroundColor='#086D71'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(8, 109, 113, 0.3)'">
                <i class="bi bi-arrow-left me-2" style="font-size: 1rem;"></i>
                <span class="back-text">Return to GoodOver</span>
            </a>
        </div>
        
        <div class="container-fluid vh-100">
            <div class="row h-100">
                <div class="col px-0 vh-100 d-none d-lg-block">
                    <img src="{{ asset('images/register.jpg') }}" alt="" class="h-100 w-100 object-fit-cover">
                </div>

                <div class="col px-0 h-max d-flex flex-column align-items-center justify-content-center">
                    <div style="max-width: 420px; width: 80%;">
                        <div class="mb-4" style="max-width: 225px; width: 90%">
                            <img src="{{ asset('images/title.png') }}" alt="" class="w-100">
                        </div>

                        <div class="fw-bold text-start fs-3">Seller Registration</div>
                        <div class="fs-6 mb-3">Create your store details.</div>

                        <form id="sellerWizard" action="{{ route('register.seller') }}" method="POST"
                            enctype="multipart/form-data" novalidate>
                            @csrf

                            <input type="hidden" name="wizard_step" id="wizard_step" value="{{ old('wizard_step', 0) }}">

                            {{-- STEP 1 --}}
                            <div class="step" id="step-0">
                                <div class="form-group mb-2">
                                    <label>Store name</label>
                                    <input type="text" name="name"
                                        class="form-control border-black rounded-3 @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label>Store address</label>
                                    <textarea name="address"
                                        class="form-control border-black rounded-3 @error('address') is-invalid @enderror"
                                        rows="3" required>{{ old('address') }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label>Store contact</label>
                                    <input type="text" name="contact"
                                        class="form-control border-black rounded-3 @error('contact') is-invalid @enderror"
                                        value="{{ old('contact') }}" required>
                                    @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label>Store location</label>
                                    <select name="location"
                                        class="form-select border-black rounded-3 @error('location') is-invalid @enderror"
                                        required>
                                        <option value="" disabled {{ old('location') ? '' : 'selected' }}>Choose...</option>
                                        @foreach (['Jakarta Utara','Jakarta Barat','Jakarta Timur','Jakarta
                                        Selatan','Jakarta Pusat'] as $loc)
                                        <option value="{{ $loc }}" {{ old('location')===$loc ? 'selected' : '' }}>{{ $loc }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- STEP 2 --}}
                            <div class="step" id="step-1">
                                <div class="form-group mb-2">
                                    <label>Store opening time</label>
                                    <input type="time" name="opening_time"
                                        class="form-control border-black rounded-3 @error('opening_time') is-invalid @enderror"
                                        value="{{ old('opening_time') }}" step="60" required>
                                    @error('opening_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label>Store closing time</label>
                                    <input type="time" name="closing_time"
                                        class="form-control border-black rounded-3 @error('closing_time') is-invalid @enderror"
                                        value="{{ old('closing_time') }}" step="60" required>
                                    @error('closing_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label>Upload store profile</label>
                                    <input type="file" name="image_path"
                                        class="form-control border-black rounded-3 @error('image_path') is-invalid @enderror"
                                        accept=".jpg,.jpeg,.png" required>
                                    @error('image_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <div class="small text-muted mt-1">Allowed: jpg, jpeg, png.</div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button type="button" class="btn btn-outline-secondary" id="prevBtn">Back</button>
                                <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                                <button type="submit" class="btn text-white d-none" id="submitBtn"
                                    style="background:#086D71;">
                                    Submit
                                </button>
                            </div>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                            const form = document.getElementById('sellerWizard');
                            const wizardStepInput = document.getElementById('wizard_step');

                            const steps = [
                                document.getElementById('step-0'),
                                document.getElementById('step-1'),
                            ];

                            const prevBtn = document.getElementById('prevBtn');
                            const nextBtn = document.getElementById('nextBtn');
                            const submitBtn = document.getElementById('submitBtn');

                            let current = parseInt(wizardStepInput.value || '0', 10);
                            if (Number.isNaN(current) || current < 0 || current >= steps.length) current = 0;

                            function showStep(i) {
                                steps.forEach((el, idx) => el.classList.toggle('active', idx === i));
                                prevBtn.disabled = (i === 0);
                                nextBtn.classList.toggle('d-none', i === steps.length - 1);
                                submitBtn.classList.toggle('d-none', i !== steps.length - 1);
                                wizardStepInput.value = i; // so redirect back keeps last step
                            }

                            function validateStep(i) {
                                const fields = steps[i].querySelectorAll('input, textarea, select');
                                for (const field of fields) {
                                    if (!field.checkValidity()) {
                                        field.reportValidity();
                                        return false;
                                    }
                                }
                                return true;
                            }

                            nextBtn.addEventListener('click', () => {
                                if (!validateStep(current)) return;
                                current++;
                                showStep(current);
                            });

                            prevBtn.addEventListener('click', () => {
                                current--;
                                showStep(current);
                            });

                            form.addEventListener('submit', (e) => {
                                if (!validateStep(current)) e.preventDefault();
                            });

                            showStep(current);
                        });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @include('layout.bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    {{-- Return to GoodOver Button --}}
    <div class="position-fixed top-0 start-0 m-3 back-to-goodover-btn" style="z-index: 1050;">
        <a href="{{ route('home') }}" class="btn btn-sm d-flex align-items-center text-decoration-none"
            style="background-color: #086D71; color: white; border-radius: 8px; padding: 8px 16px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(8, 109, 113, 0.3);"
            onmouseover="this.style.backgroundColor='#065a5e'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(8, 109, 113, 0.4)'"
            onmouseout="this.style.backgroundColor='#086D71'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(8, 109, 113, 0.3)'">
            <i class="bi bi-arrow-left me-2" style="font-size: 1rem;"></i>
            <span class="back-text">Return to GoodOver</span>
        </a>
    </div>

    <style>
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

    <div class="container-fluid vh-100">
        <div class="row h-100">
            <div class="col px-0 vh-10 d-none d-lg-block">
                <img src="{{ asset('images/register.jpg') }}" alt="" class="h-100 w-100 object-fit-cover">
            </div>
            <div class="col px-0 h-max d-flex flex-column align-items-center justify-content-center">
                <div style="max-width: 400px; width: 80%">
                    <div class="mb-4" style="max-width: 225px; width: 90%">
                        <img src="{{ asset('images/title.png') }}" alt="" class="w-100">
                    </div>
                    <div class="fw-bold text-start fs-3">
                        {{ __('auth.login') }}
                    </div>
                    <div class="fs-6 mb-3">
                        {{ __('auth.sub_2') }}
                    </div>
                    {{-- form --}}
                    <form action="{{ route('route.login') }}" method="post">
                        {{-- label --}}
                        @csrf
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input type="text"
                                class="form-control border-black rounded-3 @error('email') is-invalid @enderror"
                                id="email" name="email" value={{ old('email') }}>
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control border-black border-end-0 rounded-start-3 @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                <button class="btn border border-black border-start-0 rounded-end-3" type="button"
                                    id="togglePassword" style="border-left: 0;">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <script>
                            const password = document.getElementById('password');
                            const toogle = document.getElementById('togglePassword');
                            const eyeIcon = document.getElementById('eyeIcon');

                            toogle.addEventListener('click', function() {
                                const type = password.type === 'text' ? 'password' : 'text';
                                password.type = type;
                                eyeIcon.classList.toggle('bi-eye');
                                eyeIcon.classList.toggle('bi-eye-slash');
                            });
                        </script>
                        {{-- end of label --}}
                        <div class="mb-2 text-break" style=" font-size: small; color:#7B7B7B">
                            {{ __('auth.register_reminder') }}
                            <a href="{{ route('register.user.view') }}"
                                class="icon-link-hover link-underline-opacity-0 fw-bold" style="color:black">
                                Register
                            </a>
                        </div>
                        <button type="submit" class="btn mb-2 text-white w-100 fw-bold rounded-3"
                            style="background: #086D71; height: 11%">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

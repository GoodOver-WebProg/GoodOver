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
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <div class="col px-0 vh-10 d-none d-lg-block">
                <img src="{{ asset('register.jpg') }}" alt="" class="h-100 w-100 object-fit-cover">
            </div>
            <div class="col px-0 h-max d-flex flex-column align-items-center justify-content-center">
                <div style="max-width: 400px; width: 80%">
                    <div class="mb-4" style="max-width: 225px; width: 90%">
                        <img src="{{ asset('title.png') }}" alt="" class="w-100">
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
                            <input type="text" class="form-control border-black rounded-3 @error('email') is-invalid @enderror" id="email"
                                name="email" value={{ old('email') }}>
                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-black rounded-start-3 @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                <button class="btn border-black rounded-end-3" type="button" id="togglePassword" style="border-left: 0;">
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
                            <a href="{{ route('route.register.view') }}" class="icon-link-hover link-underline-opacity-0 fw-bold"
                                style="color:black">
                                Register
                            </a>
                        </div>
                        <button type="submit" class="btn mb-2 text-white w-100 fw-bold rounded-3" style="background: #086D71; height: 11%">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
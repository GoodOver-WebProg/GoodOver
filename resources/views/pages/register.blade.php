<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @include('layout.bootstrap')
</head>

<body>
    <div class="container-fluid min-h-dvh">
        <div class="row">
            <div class="col-7 px-0 vh-100">
                <img src="{{ asset('register.jpg') }}" alt="" class="h-100 w-100 object-fit-cover">
            </div>
            <div class="col px-0 h-max d-flex flex-column align-items-center justify-content-center">
                <div style="width: 300px">
                    <div class="mb-4" style="width: 225px">
                        <img src="{{ asset('title.png') }}" alt="" class="w-100">
                    </div>
                    <div class="fw-bold text-start fs-3">
                        Sign up your account
                    </div>
                    <div class="fs-6 mb-3">
                        And start your journey at GoodOver
                    </div>
                    <form action="-" method="post" class="mb-4">
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input type="text" class="form-control border-black rounded-3" @error('email') is-invalid
                                @enderror id="email" name="email" value={{ old('email') }}>
                        </div>
                        <div class="form-group mb-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control border-black rounded-3" @error('username') is-invalid
                                @enderror id="username" name="username" value={{ old('username') }}>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control border-black rounded-3" @error('password')
                                is-invalid @enderror id="password" name="password" value={{ old('password') }}>
                        </div>
                    </form>
                    <div class="mb-1 text-break" style=" font-size: small; color:#7B7B7B">
                        By proceeding, you agree to GoodOver's
                        <a href="#" class="icon-link-hover link-underline-opacity-0 fw-bold" style="color:black">
                            Privary Policy
                        </a> and
                        <a href="#" class="icon-link-hover link-underline-opacity-0 fw-bold" style="color:black">
                            Terms and Conditions
                        </a>.
                    </div>
                    <div class="mb-2 text-break" style=" font-size: small; color:#7B7B7B">
                        Already have an account?
                        <a href="#" class="icon-link-hover link-underline-opacity-0 fw-bold" style="color:black">
                            Login
                        </a>
                    </div>
                    <button type="submit" class="btn mb-2 text-white w-100 fw-bold rounded-3" style="background: #086D71; height: 11%">Submit</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
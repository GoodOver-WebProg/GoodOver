<header style="background-color: #086D71;">
    <nav class="navbar navbar-expand-lg" style="background-color: #086D71;">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="{{ route('homepage') }}"
                style="font-size: 1.5rem;">GoodOver</a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: rgba(255,255,255,0.5);">
                <span class="navbar-toggler-icon" style="background-image: url(\" data:image/svg+xml,%3csvg
                    xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30' %3e%3cpath
                    stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2'
                    d='M4 7h22M4 15h22M4 23h22' /%3e%3c/svg%3e\");"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('route.product') }}">Foods</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('route.login.view') }}">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('route.register.view') }}">Sign Up</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item ms-2 d-flex justify-content-center align-items-center">
                        <div class="dropdown">
                            <button 
                                class="rounded-circle dropdown-toggle p-0 border-0"
                                style="height: 35px; width: 35px; overflow: hidden;"
                                type="button" 
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <img src="{{ Auth::user()->image_path ?? asset('images/register.jpg') }}" alt="PP" class="h-100 w-100 object-fit-cover">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="#" class="dropdown-item">Profile</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('route.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
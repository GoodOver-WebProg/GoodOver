<header style="background-color: #086D71;">
    <nav class="navbar navbar-expand-lg" style="background-color: #086D71;">
        <div class="container">
            {{-- Left: Brand --}}
            <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}" style="font-size: 1.5rem;">GoodOver</a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: rgba(255,255,255,0.5);">
                <span class="navbar-toggler-icon"
                    style="background-image: url(\" data:image/svg+xml,%3csvg
                    xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30' %3e%3cpath
                    stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2'
                    d='M4 7h22M4 15h22M4 23h22' /%3e%3c/svg%3e\");"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Center: Search Form --}}
                <div class="mx-auto" style="max-width: 500px; width: 100%;">
                    <form action="{{ route('home') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control me-2"
                            placeholder="{{ __('home.search_placeholder') }}" value="{{ request('q') }}"
                            style="border-radius: 25px; border: none; padding: 8px 20px;">
                        <button type="submit" class="btn text-white"
                            style="background-color: rgba(255,255,255,0.2); border-radius: 25px; border: none;">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                {{-- Right: Login/User Menu + Language Switcher --}}
                <ul class="navbar-nav ms-auto align-items-center nav-animated-underline">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('route.product') }}">Foods</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('route.login.view') }}">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register.user.view') }}">Sign Up</a>
                        </li>
                        {{-- Language Switcher --}}
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link text-white dropdown-toggle d-flex align-items-center" href="#"
                                id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer; padding: 8px 12px; border-radius: 6px; transition: background-color 0.2s ease;"
                                onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'"
                                onmouseout="this.style.backgroundColor='transparent'">
                                <i class="bi bi-globe me-1" style="font-size: 1.1rem;"></i>
                                <span style="font-size: 0.95rem;">{{ strtoupper(app()->getLocale()) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown"
                                style="border-radius: 8px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.15); padding: 4px; min-width: 180px; z-index: 1030 !important;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                                        href="{{ route('lang.switch', 'en') }}"
                                        style="padding: 12px 16px; border-radius: 6px; margin: 2px 4px; {{ app()->getLocale() === 'en' ? 'background-color: #086D71 !important; color: white !important;' : 'color: #333;' }} transition: all 0.2s ease;"
                                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='#f8f9fa'"
                                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'">
                                        <span style="font-size: 1.3rem; margin-right: 12px; line-height: 1;">🇺🇸</span>
                                        <span
                                            style="font-weight: {{ app()->getLocale() === 'en' ? '600' : '400' }};">English</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center {{ app()->getLocale() === 'id' ? 'active' : '' }}"
                                        href="{{ route('lang.switch', 'id') }}"
                                        style="padding: 12px 16px; border-radius: 6px; margin: 2px 4px; {{ app()->getLocale() === 'id' ? 'background-color: #086D71 !important; color: white !important;' : 'color: #333;' }} transition: all 0.2s ease;"
                                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='#f8f9fa'"
                                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'">
                                        <span style="font-size: 1.3rem; margin-right: 12px; line-height: 1;">🇮🇩</span>
                                        <span
                                            style="font-weight: {{ app()->getLocale() === 'id' ? '600' : '400' }};">Bahasa
                                            Indonesia</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item ms-2 d-flex justify-content-center align-items-center">
                            <div class="dropdown">
                                <button class="rounded-circle dropdown-toggle p-0 border-0"
                                    style="height: 35px; width: 35px; overflow: hidden;" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->image_path ?? asset('images/register.jpg') }}"
                                        alt="PP" class="h-100 w-100 object-fit-cover">
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

@push('styles')
    <style>
        /* Navbar z-index untuk memastikan dropdown language di atas */
        header {
            position: relative;
            z-index: 1030;
        }

        .navbar {
            position: relative;
            z-index: 1030;
        }

        /* Language dropdown harus di atas semua */
        #languageDropdown+.dropdown-menu {
            z-index: 1031 !important;
        }

        /* Navbar underline animation - slide in from left, slide out to right */
        .nav-animated-underline .nav-item {
            position: relative;
        }

        .nav-animated-underline .nav-link {
            position: relative;
            overflow: visible;
            padding-bottom: 4px;
        }

        .nav-animated-underline .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: #fff;
            transition: width 0.3s ease, left 0.3s ease;
            transform-origin: left;
        }

        /* Hover: garis muncul dari kiri ke kanan */
        .nav-animated-underline .nav-link:hover::after,
        .nav-animated-underline .nav-link:focus::after {
            width: 100%;
            left: 0;
        }

        /* Mouse out: garis bergeser ke kanan dan menghilang */
        .nav-animated-underline .nav-link:not(:hover):not(:focus)::after {
            width: 0;
            left: 100%;
            transition: width 0.3s ease, left 0.3s ease;
        }

        /* Mobile: disable animation untuk touch devices */
        @media (hover: none) and (pointer: coarse) {
            .nav-animated-underline .nav-link::after {
                display: none;
            }
        }

        /* Pastikan dropdown tidak terpengaruh animasi */
        .nav-animated-underline .nav-item.dropdown .nav-link::after {
            display: none;
        }
    </style>
@endpush

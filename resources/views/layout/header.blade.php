<header style="background-color: #086D71;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #086D71;">
        <div class="container">
            {{-- Left: Brand --}}
            <a class="navbar-brand text-white fw-bold" href="{{ route('home') }}" style="font-size: 1.5rem;">GoodOver</a>

            {{-- Right side: Avatar (mobile) + Language + Hamburger --}}
            <div class="d-flex align-items-center order-lg-2 gap-3">
                {{-- User Avatar - Show on mobile, outside collapse --}}
                @auth
                    <div class="dropdown d-lg-none">
                        <button class="rounded-circle dropdown-toggle p-0 border-0 user-avatar-mobile"
                            style="height: 38px; width: 38px; overflow: hidden;" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ Auth::user()->image_path ?? asset('images/register.jpg') }}" alt="User Avatar"
                                class="h-100 w-100 object-fit-cover">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end"
                            style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                            <li>
                                <a href="#" class="dropdown-item">
                                    <i class="bi bi-person me-2"></i>Profile
                                </a>
                            </li>
                            @role('seller')
                                <li>
                                    <a href="{{ route('seller.dashboard') }}" class="dropdown-item">
                                        <i class="bi bi-shop me-2"></i>Seller Dashboard
                                    </a>
                                </li>
                            @endrole
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('route.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                {{-- Language Switcher - Mobile --}}
                <div class="dropdown d-lg-none language-mobile-dropdown">
                    <button class="btn btn-link text-white p-0 dropdown-toggle-no-caret" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        style="font-size: 1.3rem; line-height: 1; border: none; background: transparent;">
                        <i class="bi bi-globe"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end language-mobile-menu"
                        style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); min-width: 120px; padding: 0.5rem;">
                        <li>
                            <a class="dropdown-item text-center {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                                href="{{ route('lang.switch', 'en') }}"
                                style="padding: 10px; border-radius: 6px; {{ app()->getLocale() === 'en' ? 'background-color: #086D71 !important; color: white !important;' : 'color: #333;' }}">
                                EN
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-center {{ app()->getLocale() === 'id' ? 'active' : '' }}"
                                href="{{ route('lang.switch', 'id') }}"
                                style="padding: 10px; border-radius: 6px; {{ app()->getLocale() === 'id' ? 'background-color: #086D71 !important; color: white !important;' : 'color: #333;' }}">
                                ID
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Hamburger --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                            <path stroke="white" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2.5"
                                d="M4 7h22M4 15h22M4 23h22"></path>
                        </svg>
                    </span>
                </button>
            </div>

            <div class="collapse navbar-collapse order-lg-1" id="navbarNav">
                {{-- Center: Search --}}
                <div class="mx-auto navbar-search-container" style="max-width: 500px; width: 100%;">
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

                {{-- Right Side Menu --}}
                <ul class="navbar-nav ms-auto align-items-center nav-animated-underline">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('route.product') }}">Foods</a></li>

                    @guest
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('route.login.view') }}">Log In</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register.user.view') }}">Sign Up</a></li>

                        {{-- Language Switcher Desktop --}}
                        <li class="nav-item dropdown language-dropdown d-none d-lg-block">
                            <a class="nav-link text-white dropdown-toggle d-flex align-items-center" href="#"
                                id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer; padding: 8px 12px; border-radius: 6px; transition: background-color 0.2s;">
                                <i class="bi bi-globe me-2"></i>
                                <span class="language-text">
                                    {{ app()->getLocale() === 'en' ? 'English' : 'Bahasa Indonesia' }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                <li>
                                    <a class="dropdown-item text-center {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                                        href="{{ route('lang.switch', 'en') }}">
                                        English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-center {{ app()->getLocale() === 'id' ? 'active' : '' }}"
                                        href="{{ route('lang.switch', 'id') }}">
                                        Bahasa Indonesia
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest

                    @auth
                        {{-- Language Switcher Auth Desktop --}}
                        <li class="nav-item dropdown language-dropdown d-none d-lg-block">
                            <a class="nav-link text-white dropdown-toggle d-flex align-items-center" href="#"
                                id="languageDropdownAuth" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer; padding: 8px 12px;">
                                <i class="bi bi-globe me-2"></i>
                                <span class="language-text">
                                    {{ app()->getLocale() === 'en' ? 'English' : 'Bahasa Indonesia' }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.15); padding: 8px;">
                                <li>
                                    <a class="dropdown-item text-center {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                                        href="{{ route('lang.switch', 'en') }}">
                                        English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-center {{ app()->getLocale() === 'id' ? 'active' : '' }}"
                                        href="{{ route('lang.switch', 'id') }}">
                                        Bahasa Indonesia
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- User Avatar Desktop --}}
                        <li class="nav-item ms-2 d-none d-lg-flex justify-content-center align-items-center">
                            <div class="dropdown">
                                <button class="rounded-circle dropdown-toggle p-0 border-0"
                                    style="height: 35px; width: 35px; overflow: hidden;" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->image_path ?? asset('images/register.jpg') }}"
                                        alt="User Avatar" class="h-100 w-100 object-fit-cover">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end"
                                    style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                                    <li>
                                        <a href="{{ route('route.profile.view', Auth::user()->id)}}" class="dropdown-item">Profile</a>
                                    </li>
                                    @role('seller')
                                    <li>
                                        <a href="{{ route('seller.dashboard') }}" class="dropdown-item">Seller Dashboard</a>
                                    </li>
                                    @endrole
                                    <li>
                                        <form method="POST" action="{{ route('route.logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </button>
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
/* (CSS tetap sama seperti versi yang kamu kirim) */
</style>
@endpush

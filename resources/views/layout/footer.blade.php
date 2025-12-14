<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row g-4 mb-4">
            {{-- Left Section --}}
            <div class="col-lg-4 col-md-6">
                <h3 class="fw-bold mb-3" style="font-size: 1.8rem; color: #ffffff;">GoodOver</h3>
                <p class="text-secondary mb-4" style="line-height: 1.6; max-width: 300px;">
                    Save food, save money, and help reduce food waste with GoodOver.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-light text-decoration-none"
                        style="font-size: 1.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='#086D71'"
                        onmouseout="this.style.color='#ffffff'" aria-label="Twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="text-light text-decoration-none"
                        style="font-size: 1.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='#086D71'"
                        onmouseout="this.style.color='#ffffff'" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="text-light text-decoration-none"
                        style="font-size: 1.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='#086D71'"
                        onmouseout="this.style.color='#ffffff'" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="text-light text-decoration-none"
                        style="font-size: 1.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='#086D71'"
                        onmouseout="this.style.color='#ffffff'" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            {{-- Middle Section --}}
            <div class="col-lg-2 col-md-6">
                <h5 class="text-uppercase fw-semibold mb-3"
                    style="color: #ffffff; font-size: 0.9rem; letter-spacing: 1px;">Menu</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-secondary text-decoration-none"
                            style="transition: color 0.3s ease;" onmouseover="this.style.color='#ffffff'"
                            onmouseout="this.style.color='#6c757d'">
                            Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('home') }}#foods" class="text-secondary text-decoration-none"
                            style="transition: color 0.3s ease;" onmouseover="this.style.color='#ffffff'"
                            onmouseout="this.style.color='#6c757d'">
                            Foods
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none"
                            style="transition: color 0.3s ease;" onmouseover="this.style.color='#ffffff'"
                            onmouseout="this.style.color='#6c757d'">
                            About
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none"
                            style="transition: color 0.3s ease;" onmouseover="this.style.color='#ffffff'"
                            onmouseout="this.style.color='#6c757d'">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Right Section --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="text-uppercase fw-semibold mb-3"
                    style="color: #ffffff; font-size: 0.9rem; letter-spacing: 1px;">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-envelope text-secondary"></i>
                        <a href="mailto:support@goodover.com" class="text-secondary text-decoration-none"
                            style="transition: color 0.3s ease;" onmouseover="this.style.color='#ffffff'"
                            onmouseout="this.style.color='#6c757d'">
                            support@goodover.com
                        </a>
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt text-secondary"></i>
                        <span class="text-secondary">Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-top border-secondary pt-4 mt-4">
            <div class="text-center text-secondary">
                <p class="mb-0" style="font-size: 0.9rem;">© 2025 GoodOver. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

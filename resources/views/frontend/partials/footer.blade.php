<footer class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container py-2">
        <div class="row align-items-center w-100">

            <!-- Brand & Description -->
            <div class="col-lg-5 mb-2 mb-lg-0">
                <h6 class="fw-bold text-white mb-1">
                    <i class="bi bi-building-check me-2"></i>
                    Company Rating System
                </h6>
                <p class="text-white mb-0 small">
                    A trusted platform to explore, review, and rate companies.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 text-center mb-2 mb-lg-0">
                <a href="{{ route('web.home') }}" class="text-decoration-none text-white mx-2">
                    Home
                </a>

                <a href="{{ route('web.aboutUs.index') }}"
                    class="text-decoration-none text-white mx-2">
                    About Us
                </a>

                <a href="{{ route('web.contactUs.create') }}"
                    class="text-decoration-none text-white mx-2">
                    Contact Us
                </a>
            </div>

            <!-- Copyright -->
            <div class="col-lg-3 text-lg-end">
                <small class="text-white">
                    © {{ date('Y') }} Company Rating System
                </small>
            </div>

        </div>
    </div>
</footer>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="{{ route('web.home') }}">
            <i class="bi bi-star-fill"></i>
            Company Rating System
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Companies</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.aboutUs.index') }}">About us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.contactUs.create') }}">Contact us</a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            @if (auth()->user()->avatar)
                                <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                    class="rounded-circle me-1"
                                    style="width: 32px; height: 32px; object-fit: cover; border: 2px solid white;"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">

                                <i class="bi bi-person-circle" style="display:none;"></i>
                            @else
                                <i class="bi bi-person-circle"></i>
                            @endif

                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('backend.dashboard.index') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('web.auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a href="{{ route('web.auth.showLogin') }}" class="btn btn-primary">
                            Login
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

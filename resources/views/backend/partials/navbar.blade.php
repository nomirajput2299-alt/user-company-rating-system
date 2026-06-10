<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-3">

    <div class="container-fluid">
        <button class="btn btn-outline-dark btn-sm" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            <span class="me-3 text-muted">
                @if (auth()->user()->avatar)
                    <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                        class="rounded-circle me-1"
                        style="width: 32px; height: 32px; object-fit: cover; border: 2px solid black;"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">

                    <i class="bi bi-person-circle" style="display:none;"></i>
                @else
                    <i class="bi bi-person-circle"></i>
                @endif

                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('web.auth.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

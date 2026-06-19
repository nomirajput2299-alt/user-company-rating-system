<div class="bg-dark border-end sidebar" id="sidebar-wrapper" style="width: 260px; min-height: 100vh;">
    <!-- Company Rating -->
    <div class="sidebar-heading text-white p-3 fw-bold border-bottom">
        <a href="{{ route('Web.Home') }}" class="text-decoration-none text-white">Company Rating</a>
    </div>

    <div class="list-group list-group-flush">
        <!-- Dashboard -->
        <a href="{{ route('backend.dashboard.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        @role('admin')
        <!-- Users -->
        <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="bi bi-people me-2"></i> Users
        </a>
        @endrole

        <!-- Companies -->
        <a href="{{ route('admin.company.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="bi bi-building me-2"></i> Companies
        </a>
        <!-- Companies -->
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="bi bi-star me-2"></i> Ratings
        </a>
    </div>
</div>

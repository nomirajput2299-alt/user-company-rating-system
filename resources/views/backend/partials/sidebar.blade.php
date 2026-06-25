<div class="bg-dark border-end sidebar" id="sidebar-wrapper" style="width: 260px; min-height: 100vh;">
    <!-- Company Rating -->
    <div class="sidebar-heading text-white p-3 fw-bold border-bottom">
        <a href="{{ route('web.home') }}" class="text-decoration-none text-white">Company Rating</a>
    </div>

    <div class="list-group list-group-flush">
        <!-- Dashboard -->
        <a href="{{ route('backend.dashboard.index') }}"
            class="list-group-item list-group-item-action text-white
            {{ request()->routeIs('backend.dashboard.index') ? 'active' : 'bg-dark' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <!-- /.... Dashboard -->

        @role('admin')
            <!-- Users -->
            <a href="{{ route('admin.user.index') }}"
                class="list-group-item list-group-item-action text-white
             {{ request()->routeIs('admin.user.*') ? 'active' : 'bg-dark' }}">
                <i class="bi bi-people me-2"></i> Users
            </a>
        @endrole

        <!-- Companies -->
        <a href="{{ auth()->user()->hasRole('admin') ? route('admin.company.index') : route('user.company.index') }}"
            class="list-group-item list-group-item-action text-white
            {{ request()->routeIs('admin.company.*', 'user.company.*') ? 'active' : 'bg-dark' }}">
            <i class="bi bi-building me-2"></i> Companies
        </a>

        <!-- Companies -->
        <a href="#"
        class="list-group-item list-group-item-action text-white
        {{ request()->routeIs('#') ? 'active' : 'bg-dark' }}">
            <i class="bi bi-star me-2"></i> Ratings
        </a>

        @role('admin')
         <!-- Feedback -->
            <a href="{{ route('admin.feedback.index') }}"
                class="list-group-item list-group-item-action text-white
             {{ request()->routeIs('admin.feedback.index') ? 'active' : 'bg-dark' }}">
                <i class="bi bi-people me-2"></i> Feedback
            </a>
        @endrole
    </div>
</div>

@extends('backend.layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="row g-3">

        @role('admin')
            <!--- Total User --->
            <div class="col-md-4">
                <a href="{{ route('admin.user.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Users</h6>
                                <h3 class="counter mb-0" data-target="{{ $totalUsers }}">0</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                <i class="bi bi-people-fill fs-3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--- /....Total User --->

            <!--- Total Companies --->
            <div class="col-md-4">
                <a href="{{ route('admin.company.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted">Total Companies</h6>
                                <h3 class="counter" data-target="{{ $totalCompanies }}">0</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                <i class="bi bi-building fs-3 text-success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--- /....Total Companies --->
        @endrole

        <!--- My Companies --->
        <div class="col-md-4">
            <a href="{{ auth()->user()->hasRole('admin') ? route('admin.company.index') : route('user.company.index') }}"
                class="text-decoration-none">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">My Companies</h6>
                            <h3 class="counter" data-target="{{ $myCompanies }}">0</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-building fs-3 text-success"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!--- /....My Companies --->

    </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/dashboardCount.js') }}"></script>
@endpush

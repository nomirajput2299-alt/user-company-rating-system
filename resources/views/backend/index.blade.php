@extends('backend.layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="row g-3">

        @role('admin')
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Users</h6>
                        <h3 class="counter" data-target="{{ $totalUsers }}">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Companies</h6>
                        <h3 class="counter" data-target="{{ $totalCompanies }}">0</h3>
                    </div>
                </div>
            </div>
        @endrole

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">My Companies</h6>
                    <h3 class="counter" data-target="{{ $myCompanies }}">0</h3>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/dashboardCount.js') }}"></script>
@endpush

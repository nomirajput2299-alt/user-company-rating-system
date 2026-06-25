@extends('frontend.layouts.main')
@section('title', 'Home')
@push('css')
@endpush
@section('content')
    <div class="container py-5">

        <!-- Hero Section -->
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="card-body p-5">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-primary mb-3 px-3 py-2">
                            Company Rating Platform
                        </span>
                        <h1 class="display-5 fw-bold mb-3">
                            Discover, Rate & Compare Companies
                        </h1>
                        <p class="lead text-muted mb-4">
                            Make informed decisions by exploring company ratings,
                            reviews, and performance insights shared by users.
                            Find the best companies and contribute your own ratings.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-primary btn-lg">
                                <i class="bi bi-search me-2"></i>Browse Companies
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-star me-2"></i>Start Rating
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center mt-4 mt-lg-0">
                        <i class="bi bi-bar-chart-line-fill text-primary" style="font-size: 10rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-buildings fs-1 text-primary"></i>
                        </div>
                        <h3 class="fw-bold counter" data-target="{{ $totalCompanies }}" >0</h3>
                        <p class="text-muted mb-0">Registered Companies</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-people-fill fs-1 text-success"></i>
                        </div>
                        <h3 class="fw-bold counter" data-target="{{ $totalUsers }}">0</h3>
                        <p class="text-muted mb-0">Active Users </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-star-fill fs-1 text-warning"></i>
                        </div>
                        <h3 class="fw-bold">{{ $totalRatings ?? 0 }}</h3>
                        <p class="text-muted mb-0">Ratings Submitted</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Features -->
        <div class="mt-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Use Our Platform?</h2>
                <p class="text-muted">
                    A trusted place to evaluate and compare companies.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-star-fill text-warning fs-1"></i>
                            <h5 class="mt-3">Rate Companies</h5>
                            <p class="text-muted">
                                Share your experience and help others make informed decisions.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-graph-up-arrow text-success fs-1"></i>
                            <h5 class="mt-3">Compare Ratings</h5>
                            <p class="text-muted">
                                Compare companies based on community feedback and scores.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-shield-check text-primary fs-1"></i>
                            <h5 class="mt-3">Trusted Reviews</h5>
                            <p class="text-muted">
                                Access reliable ratings and reviews from verified users.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
        <script type="text/javascript" src="{{ asset('backend/js/dashboardCount.js') }}"></script>
@endpush

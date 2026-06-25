@extends('frontend.layouts.main')
@section('title', 'About Us')
@push('css')

@endpush
@section('content')
    <div class="container py-5">

        <!-- Hero Section -->
        <div class="text-center mb-5">
            <span class="badge bg-primary px-3 py-2 mb-3">
                About Company Rating System
            </span>

            <h1 class="display-5 fw-bold">
                Empowering Better Business Decisions
            </h1>

            <p class="lead text-muted mx-auto" style="max-width: 800px;">
                Company Rating System is a trusted platform that helps users
                discover, evaluate, and compare companies through transparent
                ratings and valuable feedback from the community.
            </p>
        </div>

        <!-- About Content -->
        <div class="row align-items-center g-5 mb-5">

            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a" class="img-fluid rounded shadow"
                    alt="About Company Rating System">
            </div>

            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Who We Are</h2>

                <p class="text-muted">
                    We believe that informed decisions lead to better outcomes.
                    Our platform provides users with a centralized space to
                    explore company profiles, share experiences, and view
                    authentic ratings from others.
                </p>

                <p class="text-muted">
                    Whether you're a customer looking for reliable services or
                    a business striving to improve its reputation, our goal is
                    to create transparency and trust through meaningful feedback.
                </p>

                <div class="mt-4">
                    <a href="#" class="btn btn-primary">
                        Explore Companies
                    </a>
                </div>
            </div>

        </div>

        <!-- Mission & Vision -->
        <div class="row g-4 mb-5">

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-bullseye fs-1 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Our Mission</h4>
                        <p class="text-muted mb-0">
                            To provide a reliable and transparent platform where
                            users can evaluate companies, share experiences, and
                            make informed decisions with confidence.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-eye-fill fs-1 text-success"></i>
                        </div>
                        <h4 class="fw-bold">Our Vision</h4>
                        <p class="text-muted mb-0">
                            To become the leading company review and rating
                            platform that promotes accountability, trust, and
                            excellence across industries.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Core Values -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">Our Core Values</h2>
            <p class="text-muted">
                Principles that guide everything we do.
            </p>
        </div>

        <div class="row g-4 mb-5">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-shield-check fs-1 text-primary"></i>
                        <h5 class="mt-3">Trust</h5>
                        <p class="text-muted">
                            We prioritize authenticity and transparency in every rating.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-people-fill fs-1 text-success"></i>
                        <h5 class="mt-3">Community</h5>
                        <p class="text-muted">
                            Building a strong community through shared experiences.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-award-fill fs-1 text-warning"></i>
                        <h5 class="mt-3">Excellence</h5>
                        <p class="text-muted">
                            Encouraging businesses to improve through constructive feedback.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Call To Action -->
        <div class="card bg-primary text-white border-0 shadow">
            <div class="card-body text-center py-5">
                <h2 class="fw-bold mb-3">
                    Join Our Growing Community
                </h2>

                <p class="mb-4">
                    Explore companies, share your experiences, and help others make
                    better business decisions.
                </p>

                <a href="#" class="btn btn-light btn-lg">
                    Get Started Today
                </a>
            </div>
        </div>

    </div>
@endsection

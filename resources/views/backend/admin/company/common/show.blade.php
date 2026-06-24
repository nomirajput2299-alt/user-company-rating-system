@extends('backend.layouts.main')
@section('title', 'Company - View')
@push('styles')
@endpush
@section('content')
    <!-- Container -->
    <div class="container py-4">
        <!-- Card -->
        <div class="card shadow-sm border-0 rounded-4">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center pt-4 px-4">
                <h5 class="mb-0 fw-bold text-dark">Company Profile</h5>
                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.company.index') : route('user.company.index') }}"
                    class="btn btn-outline-secondary btn-sm rounded-pill">
                    ← Back
                </a>
            </div>
            <!-- End of Card Header -->

            <!-- Card Body -->
            <div class="card-body px-4 pb-4">
                @php
                    // Random colors array
                    $colors = [
                        ['bg' => '#0d6efd', 'border' => '#084298'], // blue
                        ['bg' => '#198754', 'border' => '#0f5132'], // green
                        ['bg' => '#dc3545', 'border' => '#842029'], // red
                        ['bg' => '#6f42c1', 'border' => '#432874'], // purple
                    ];

                    // Pick random color
                    $randomColor = $colors[array_rand($colors)];
                @endphp

                <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                    <!-- initial -->
                    <div>
                        <div class="d-flex align-items-center justify-content-center rounded-circle"
                            style=" width:90px; height:90px; background-color: {{ $randomColor['bg'] }}; border:2px solid {{ $randomColor['border'] }};">
                            <h3 class="text-white mb-0">
                                {{ strtoupper($company->initial) }}
                            </h3>
                        </div>
                    </div>

                    <!-- Name, Email & Status -->
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">{{ $company->name }}</h4>
                        <p class="text-muted mb-2 small"><i class="bi bi-envelope me-1"></i> {{ $company->email }}</p>
                        <div class="d-flex gap-2">
                            @if ($company->status)
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1">
                                    Active
                                </span>
                            @else
                                <span
                                    class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3 py-1">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3">
                    <!-- ID -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Company ID</span>
                        <span class="text-dark fw-semibold">#{{ $company->id }}</span>
                    </div>
                    <!-- /.... ID -->

                    <!-- User Name -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">User Name</span>
                        <span class="text-dark">{{ $company->user->name }}</span>
                    </div>
                    <!-- /.... User Name -->

                    <!-- Phone Number -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Phone Number</span>
                        <span class="text-dark">{{ $company->phoneNumber ?? '—' }}</span>
                    </div>
                    <!-- /.... Phone Number -->

                    <!-- Description -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Description</span>
                        <span class="text-dark">{{ $company->description ?? 'N/A' }}</span>
                    </div>
                    <!-- /.... Description -->

                    <!-- City -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">City</span>
                        <span class="text-dark">{{ $company->city ?? 'N/A' }}</span>
                    </div>
                    <!-- /.... City -->

                    <!-- Created On -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Created On</span>
                        <span
                            class="text-dark small">{{ $company->created_at ? $company->created_at->format('d M Y, g:i A') : '—' }}</span>
                    </div>
                    <!-- /.... Created On -->

                </div>
            </div>
            <!-- /... End of Card Body --->
        </div>
        <!-- End of Card -->
    </div>
    <!-- End of Container -->
@endsection
@push('scripts')
@endpush

@extends('backend.layouts.main')
@section('title', 'User - Details')
@push('styles')
@endpush
@section('content')
    <!-- Container -->
    <div class="container py-4">
        <!-- Card -->
        <div class="card shadow-sm border-0 rounded-4">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center pt-4 px-4">
                <h5 class="mb-0 fw-bold text-dark">User Profile</h5>
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    ← Back
                </a>
            </div>
            <!-- End of Card Header -->

            <!-- Card Body -->
            <div class="card-body px-4 pb-4">
                <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                    <!-- Avatar -->
                    <div>
                        @if ($user->avatar)
                            <img src="{{ asset($user->avatar) }}" width="80" height="80"
                                class="rounded-circle object-fit-cover border shadow-sm">
                        @else
                            <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center border shadow-sm"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-person fs-2"></i>
                            </div>
                        @endif
                    </div>
                    <!-- /.... Avatar -->

                    <!-- Name, Email, Role & Status -->
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">{{ $user->name }}</h4>
                        <p class="text-muted mb-2 small"><i class="bi bi-envelope me-1"></i> {{ $user->email }}</p>
                        <div class="d-flex gap-2">
                            <span class="badge rounded-pill bg-primary px-3 py-1.5 small">
                                {{ ucfirst($user->getRoleNames()->first() ?? 'No Role') }}
                            </span>
                            @if ($user->status)
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1.5">Active</span>
                            @else
                                <span
                                    class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.... Name, Email, Role & Status -->
                </div>


                <div class="d-flex flex-column gap-3">
                    <!-- ID -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">User ID</span>
                        <span class="text-dark fw-semibold">#{{ $user->id }}</span>
                    </div>
                    <!-- /.... ID -->

                    <!-- Phone Number -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Phone Number</span>
                        <span class="text-dark">{{ $user->phoneNumber ?? '—' }}</span>
                    </div>
                    <!-- /.... Phone Number -->

                    <!-- Email Verified -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Email Verified</span>
                        <span>
                            @if ($user->email_verified_at)
                                <span class="text-success"><i class="bi bi-patch-check-fill me-1"></i> Verified</span>
                            @else
                                <span class="text-warning"><i class="bi bi-exclamation-triangle-fill me-1"></i> Pending
                                    Verification
                                </span>
                            @endif
                        </span>
                    </div>
                    <!-- /.... Email Verified -->

                    <!-- Created On -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Created On</span>
                        <span
                            class="text-dark small">{{ $user->created_at ? $user->created_at->format('d M Y, g:i A') : '—' }}</span>
                    </div>
                    <!-- /.... Created On -->

                    <!-- Last Updated -->
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="text-muted fw-medium">Last Updated</span>
                        <span
                            class="text-dark small">{{ $user->updated_at ? $user->updated_at->format('d M Y, g:i A') : '—' }}</span>
                    </div>
                    <!-- /.... Last Updated -->
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

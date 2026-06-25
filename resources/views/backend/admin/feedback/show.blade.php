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
                <h5 class="mb-0 fw-bold text-dark">User Feedback</h5>
                <a href="{{ route('admin.feedback.index') }}"
                    class="btn btn-outline-secondary btn-sm rounded-pill">
                    ← Back
                </a>
            </div>
            <!-- End of Card Header -->

            <!-- Card Body -->
            <div class="card-body px-4 pb-4">

                <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                    <!-- Name, Email -->
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">{{ $feedback->name }}</h4>
                        <p class="text-muted mb-2 small"><i class="bi bi-envelope me-1"></i> {{ $feedback->email }}</p>
                    </div>
                </div>
                <!-- /.... Name, Email -->

                <div class="d-flex flex-column gap-3">
                    <!-- ID -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Feedback ID</span>
                        <span class="text-dark fw-semibold">#{{ $feedback->id }}</span>
                    </div>
                    <!-- /.... ID -->

                    <!-- Phone Number -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Phone Number</span>
                        <span class="text-dark">{{ $feedback->phoneNumber ?? '—' }}</span>
                    </div>
                    <!-- /.... Phone Number -->

                    <!-- Subject -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Subject</span>
                        <span class="text-dark">{{ $feedback->subject ?? 'N/A' }}</span>
                    </div>
                    <!-- /.... Subject -->

                    <!-- Message -->
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                        <span class="text-muted fw-medium">Message</span>
                        <span class="text-dark">{{ $feedback->message ?? 'N/A' }}</span>
                    </div>
                    <!-- /.... Message -->
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

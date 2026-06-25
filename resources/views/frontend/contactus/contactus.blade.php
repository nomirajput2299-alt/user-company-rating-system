@extends('frontend.layouts.main')
@section('title', 'Contact Us')
@push('css')
@endpush
@section('content')
    <div class="container py-5">

        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Contact Us</h1>
            <p class="text-muted">
                We'd love to hear from you. Get in touch with us for any questions,
                suggestions, or support requests.
            </p>
        </div>

        <div class="row g-4">

            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Get In Touch</h3>

                        <div class="mb-4">
                            <h6 class="fw-bold">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                Address
                            </h6>
                            <p class="text-muted mb-0"> Lahore, Punjab, Pakistan </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold">
                                <i class="bi bi-envelope-fill text-primary me-2"></i>
                                Email
                            </h6>
                            <p class="text-muted mb-0"> support@companyrating.com </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold">
                                <i class="bi bi-telephone-fill text-primary me-2"></i>
                                Phone
                            </h6>
                            <p class="text-muted mb-0"> +92 300 1234567 </p>
                        </div>

                        <div>
                            <h6 class="fw-bold">
                                <i class="bi bi-clock-fill text-primary me-2"></i>
                                Working Hours
                            </h6>
                            <p class="text-muted mb-0"> Monday - Friday: 9:00 AM - 6:00 PM </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.... Contact Information -->

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Send a Message</h3>

                        <form action="{{ route('web.contactUs.store') }}" method="POST" id="contactUsForm">
                            @csrf
                            <!-- Name -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name"placeholder="Enter your full name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Name -->

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Enter your email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.... Name -->

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror"
                                    name="phoneNumber" placeholder="Enter Phone Number">
                                @error('phoneNumber')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- /.... Phone Number -->

                            <!-- Subject -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    name="subject" placeholder="Enter subject">
                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- /.... Subject -->

                            <!-- Message -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="6" name="message"
                                    placeholder="Write your message here..."></textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- /.... Message -->

                            <!-- Button -->
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send-fill me-2"></i>
                                Send Message
                            </button>
                            <!-- Button -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- JQuery Validation Cdn file -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- External Script  -->
    <script src="{{ asset('frontend/js/contactus/contactus.js') }}"></script>
@endpush

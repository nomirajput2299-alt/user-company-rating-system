@extends('backend.layouts.main')
@section('title', 'Create - Company')
@push('styles')
@endpush
@section('content')
    <!-- Container -->
    <div class="container py-4">
        <!-- Card -->
        <div class="card shadow-sm border-0 rounded-4">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center pt-4 px-4">
                <h5 class="mb-0 fw-bold text-dark">Create - Company</h5>
                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.company.index') : route('user.company.index') }}"
                    class="btn btn-outline-secondary btn-sm rounded-pill">
                    ← Back
                </a>
            </div>
            <!-- End of Card Header -->

            <!-- Card Body -->
            <div class="card-body px-4 pb-4">
                <form action="{{ auth()->user()->hasRole('admin') ? route('admin.company.store') : route('user.company.store') }}" method="POST" id="createForm">
                    @csrf
                    <!-- Name -->
                    <div class="form-row mb-2">
                        <label for="name">Name Company:</label>
                        <input type="text" name="name" id="name" placeholder="Company name"
                            value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Name -->

                    <!-- Email -->
                    <div class="form-row mb-2">
                        <label for="email">Email Company:</label>
                        <input type="text" name="email" id="email" placeholder="Company email"
                            value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Email -->

                    <!-- Phone Number -->
                    <div class="form-row mb-2">
                        <label for="phoneNumber">Company Phone Number:</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Company phone number"
                            value="{{ old('phoneNumber') }}"
                            class="form-control @error('phoneNumber') is-invalid @enderror">
                        @error('phoneNumber')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Phone Number -->

                    <!-- Description -->
                    <div class="form-row mb-2">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="5" placeholder="Company description"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Description -->

                    <!-- City  -->
                    <div class="form-row mb-2">
                        <label for="city">City:</label>
                        <input type="text" name="city" id="city" placeholder="Company city"
                            value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror">
                        @error('city')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... City -->

                    <!-- Status -->
                    <div class="mb-2">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox"
                                id="status" name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                            <label class="form-check-label" for="status" id="statusLabel">
                                {{-- Inactive --}}
                                {{ old('status') ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Status -->

                    <!-- Action Button -->
                    <div class="d-flex justify-content-end mb-2">
                        <a href="{{ route('admin.company.index') }}" class="btn btn-info me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /... End of Card Body --->
        </div>
        <!-- End of Card -->
    </div>
    <!-- End of Container -->
@endsection
@push('scripts')
    <!-- JQuery Validation Cdn file -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- External Script  -->
    <script type="text/javascript" src="{{ asset('backend/js/admin/company/create.js') }}"></script>

    <!--- script for Status Toggle button --->
    <script type="text/javascript" src="{{ asset('backend/js/common/statusToggle.js') }}"></script>
@endpush

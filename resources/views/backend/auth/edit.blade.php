@extends('backend.layouts.main')
@section('title', 'User - Edit')
@push('styles')
@endpush
@section('content')
    <!-- Container -->
    <div class="container py-4">
        <!-- Card -->
        <div class="card shadow-sm border-0 rounded-4">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center pt-4 px-4">
                <h5 class="mb-0 fw-bold text-dark">User - Edit</h5>
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    ← Back
                </a>
            </div>
            <!-- End of Card Header -->

            <!-- Card Body -->
            <div class="card-body px-4 pb-4">
                <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data" id="editForm">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="userId" id="userId" value="{{ $user->id }}" readonly>
                    <!-- Name -->
                    <div class="form-row mb-2">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name"
                            value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Name -->

                    <!-- Email -->
                    <div class="form-row mb-2">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email"
                            value="{{ old('email', $user->email) }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Email -->

                    <!-- Phone Number -->
                    <div class="form-row mb-2">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number"
                            value="{{ old('phoneNumber', $user->phoneNumber) }}"
                            class="form-control @error('phoneNumber') is-invalid @enderror">
                        @error('phoneNumber')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Phone Number -->

                    <!-- Avatar -->
                    <div class="form-row mb-2">
                        <label for="avatar">Avatar:</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*"
                            class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                    </div>
                    <!-- Avatar -->

                    <!-- Role -->
                    <div class="mb-2">
                        <label for="">Role</label>
                        <select name="roles" id="roles" class="form-control @error('roles') is-invalid @enderror">
                            <option value="" selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('roles', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('roles')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Role -->

                    <!-- Password -->
                    <div class="mb-2">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Enter the password"
                                class="form-control @error('password') is-invalid @enderror">
                            <span class="input-group-text" onclick="togglePassword('password', this)">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Password -->

                    <!-- Confirm Password -->
                    <div class="mb-2">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Enter the confirmation password"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Confirm Password -->

                    <!-- Status -->
                    <div class="mb-2">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox"
                                id="status" name="status" value="1"
                                {{ old('status', $user->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status" id="statusLabel">
                                {{-- Inactive --}}
                                {{ old('status', $user->status) ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- /.... Status -->

                    <!-- Action Button -->
                    <div class="d-flex justify-content-end mb-2">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-info me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
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

    <script type="text/javascript" src="{{ asset('backend/js/auth/edit.js') }}"></script>
@endpush

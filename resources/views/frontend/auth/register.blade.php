<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon/image.png') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/auth/register.css') }}">
</head>

<body>

    <div class="auth-card">
        <div class="card p-4 shadow">
            <h4 class="text-center mb-4">Register</h4>
            <form id="signupForm" method="POST" action="{{ route('web.auth.signup') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="type" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label>Phone Number</label>
                    <input type="text" name="phoneNumber" id="phoneNumber"
                        class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="Enter phone number"
                        value="{{ old('phoneNumber') }}">
                    @error('phoneNumber')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Avatar -->
                <div class="mb-3">
                    <label>Avatar</label>
                    <input type="file" name="avatar" id="avatar"
                        class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        <span class="input-group-text" onclick="togglePassword('password', this)">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror">
                        <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Create Account -->
                <button class="btn btn-success w-100">Create Account</button>
            </form>

            <div class="text-center mt-3">
                <small>
                    Already have an account?
                    <a href="{{ route('web.auth.showLogin') }}">Login</a>
                </small>
            </div>
            <!-- Back to home -->
            <div class="text-center mt-3">
                <small>
                    Back to home
                    <a href="{{ route('web.home') }}" class="text-decoration-none">
                        <i class="bi bi-house-door-fill"></i>
                    </a>
                </small>
            </div>

        </div>

    </div>

    <!-- JQuery -->
    <script src="{{ asset('frontend/assets/js/jquery-4.0.0.min.js') }}"></script>
    <!-- JQuery Validation Cdn file -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- External script file -->
    <script type="text/javascript" src="{{ asset('frontend/js/auth/register.js') }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon/image.png') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/auth/login.css') }}">
</head>

<body>
    <div class="auth-card">
        <div class="card p-4 shadow">
            <!-- login -->
            <h4 class="text-center mb-4">Login</h4>

            <!-- Alert -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('web.auth.login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter email"
                        value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- password -->
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <!-- Login Button -->
                <button class="btn btn-primary w-100">Login</button>
            </form>

            <!-- Don't have an account -->
            <div class="text-center mt-3">
                <small>
                    Don't have an account?
                    <a href="{{ route('web.auth.showSignup') }}">Register</a>
                </small>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('frontend/assets/js/jquery-4.0.0.min.js') }}"></script>
    <!-- JQuery Validation Cdn file -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <!-- External js file -->
    <script type="text/javascript" src="{{ asset('frontend/js/auth/login.js') }}"></script>
</body>

</html>

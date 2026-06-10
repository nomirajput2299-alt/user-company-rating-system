<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title', 'Company Rating System')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon/image.png') }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    @stack('css')
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <!-- Navbar -->
    @include('frontend.partials.navbar')
    <!-- Main Content -->
    <main class="flex-grow-1">
        <div class="container-fluid px-4 py-4">
            <!-- Alert -->
            @include('frontend.partials.alert')

            <!-- Main dynamic content -->
            @yield('content')
        </div>

    </main>

    <!-- Footer -->
    @include('frontend.partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('frontend/assets/js/jquery-4.0.0.min.js') }}"></script>
    <!-- Custom JS -->
    @stack('js')
</body>
</html>

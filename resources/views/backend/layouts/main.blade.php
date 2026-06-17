<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon/image.png') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <style>
        .sidebar {
            width: 250px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .sidebar.hide {
            margin-left: -250px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="d-flex" id="wrapper">

        {{-- SIDEBAR --}}
        @include('backend.partials.sidebar')

        {{-- PAGE CONTENT --}}
        <div id="page-content-wrapper" class="w-100">

            {{-- NAVBAR --}}
            @include('backend.partials.navbar')

            <div class="container-fluid p-4">

                {{-- FLASH MESSAGES --}}
                @include('backend.partials.alert')

                {{-- PAGE CONTENT --}}
                @yield('content')

            </div>

            {{-- FOOTER --}}
            @include('backend.partials.footer')

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('frontend/assets/js/jquery-4.0.0.min.js') }}"></script>
    <!-- Custom JS -->
    {{-- <script src="{{ asset('backend/js/app.js') }}"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar-wrapper');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('hide');
            });
        });
    </script>

    @stack('scripts')

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    @stack('styles')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Navbar -->
            @include('admin.partials.header')

            <!-- Content -->
            <main class="container my-4">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('admin.partials.footer')
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>

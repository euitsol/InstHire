<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Dashboard') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    @stack('style_links')

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('student.partials.styles')
    @stack('styles')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif

            @if (session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('student.partials.sidebar')

        <!-- Main Content -->
        <div class="main">
            <!-- Top Navigation -->
            @include('student.partials.header')

            <!-- Page Content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('student.partials.footer')
        </div>
    </div>

    <!-- Scripts -->
    @include('student.partials.scripts')
    @stack('script_links')
    @stack('scripts')
</body>
</html>

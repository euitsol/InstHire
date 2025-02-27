<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'light') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Dashboard') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
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
        @include('student.partials.header')
        @include('student.partials.sidebar')

        <main class="content">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </main>

        @include('student.partials.footer')
    </div>

    <!-- Scripts -->
    @include('student.partials.scripts')
    @stack('scripts')
</body>
</html>

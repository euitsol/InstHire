<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('employee/css/style.css') }}" rel="stylesheet">

    @stack('styles')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif

            @if (session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif

            @if (session('warning'))
                showAlert('warning', '{{ session('warning') }}');
            @endif
        });
    </script>

    <!-- Theme Script (Early) -->
    <script>
        // Immediately set theme to prevent flash
        const storedTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const theme = storedTheme || systemTheme;
        document.documentElement.setAttribute('data-bs-theme', theme);
    </script>
</head>
<body>
    <div class="wrapper">
        @auth('employee')
            @include('employee.partials.sidebar')
        @endauth

        <div class="main-content {{ !auth()->guard('employee')->check() ? 'ms-0' : '' }}">
            @include('employee.partials.header')

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        @auth('employee')
            <!-- Sidebar Backdrop -->
            <div class="sidebar-backdrop d-none" id="sidebarBackdrop"></div>
        @endauth
    </div>

    <!-- Scripts -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('employee/js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'light') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Institute Dashboard') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    @stack('style_links')

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('institute.partials.styles')

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
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        @if (auth()->guard('institute')->check())
            @include('institute.partials.sidebar')
        @endif

        <!-- Main Content -->
        <div class="main-content {{ !auth()->guard('institute')->check() ? 'ms-0' : '' }}">
            <!-- Header -->
            @include('institute.partials.header')

            <!-- Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            @include('institute.partials.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @stack('script_links')

    @include('institute.partials.scripts')
    <script src="{{ asset('institute/js/theme.js') }}"></script>

    @stack('scripts')
</body>

</html>

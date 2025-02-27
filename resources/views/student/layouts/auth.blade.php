<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'light') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Auth') - {{ config('app.name') }}</title>

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

<body class="bg-light">
    <main class="d-flex w-100 h-100 min-vh-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="mx-auto col-sm-10 col-md-8 col-lg-6 col-xl-5 d-table h-100">
                    <div class="align-middle d-table-cell">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('student.partials.scripts')
    @stack('scripts')
</body>
</html>

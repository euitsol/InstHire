<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('employee/css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @auth('employee')
        <div class="wrapper">
            @include('employee.partials.sidebar')
            
            <div class="main-content">
                @include('employee.partials.header')
                
                <main class="py-4">
                    @include('employee.partials.alerts')
                    @yield('content')
                </main>
            </div>

            <!-- Sidebar Backdrop -->
            <div class="sidebar-backdrop d-none" id="sidebarBackdrop"></div>
        </div>
    @else
        <main>
            @yield('content')
        </main>
    @endauth

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('employee/js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>

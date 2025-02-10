<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Institute Dashboard') - {{ config('app.name') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Styles -->
    @include('institute.partials.styles')
</head>
<body class="h-100">
    <div class="min-vh-100" id="app">
        <!-- Sidebar -->
        @include('institute.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content ms-lg-auto">
            <!-- Header -->
            @include('institute.partials.header')

            <!-- Content -->
            <main class="p-4">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('institute.partials.footer')
        </div>
    </div>

    <!-- Scripts -->
    @include('institute.partials.scripts')
</body>
</html>

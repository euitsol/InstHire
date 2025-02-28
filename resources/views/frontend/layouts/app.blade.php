<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>InstHire - Connecting Talent with Opportunity</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    @stack('style_links')

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    @stack('styles')
</head>
<body>
    @include('frontend.partials.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    <!-- Scripts -->
    @include('frontend.partials.scripts')
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Institute Dashboard') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles -->
    @include('institute.partials.styles')
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        @include('institute.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('institute.partials.scripts')
    <script src="{{ asset('institute/js/theme.js') }}"></script>
</body>
</html>

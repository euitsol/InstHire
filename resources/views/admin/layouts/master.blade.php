<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    @stack('style_links')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    @stack('styles')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

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
    <script>
        window.AppConfig = {
            urls: {
                subscription:{
                    show: @json(route('sm.subscription.show', ':id')),
                }
            }
        }
    </script>
    <script>
        const urls = {
            subscription: {
                details: "{{ route('sm.subscription.show', ['subscription' => ':id']) }}"
            },
            instituteSubscription: {
            }
        };
    </script>
</head>

<body>


    @auth
        <!-- Sidebar Backdrop -->
        <div class="sidebar-backdrop"></div>

        <!-- Sidebar -->
        @include('admin.partials.sidebar')
    @endauth

    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Main Content -->
        @auth
            <div class="main-content">
            @endauth
            <!-- Navbar -->
            @include('admin.partials.header')

            <!-- Content -->
            <main class="container-fluid py-4">
                @yield('content')
            </main>
            @auth
            </div>
        @endauth
        <!-- Footer -->
        @include('admin.partials.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('script_links')
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>

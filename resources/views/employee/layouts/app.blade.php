<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Employee Panel</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        @include('employee.partials.header')

        <div class="container-fluid">
            <div class="row">
                @include('employee.partials.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @include('employee.partials.alerts')
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @if (Auth::guest())
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/' . Auth::user()->theme->filename) }}">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Custom css -->
    @yield('css-header')
</head>

<body>
    <main class="py-2">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('script-footer')    
</body>

</html>


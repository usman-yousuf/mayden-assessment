<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Product Management')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main class="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    @stack('scripts')
</body>
</html>

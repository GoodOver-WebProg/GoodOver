<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GoodOver')</title>

    @include('layout.bootstrap')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    @include('layout.header')
    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('layout.footer')

    @stack('scripts')
</body>

</html>

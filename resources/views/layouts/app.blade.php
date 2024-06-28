<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="wh-100 wv-100">

    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
    <header class="">
        <div class="">
            {{ $header }}
        </div>
    </header>
    @endif

    <!-- Page Content -->
    <main class="container h-100">
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>
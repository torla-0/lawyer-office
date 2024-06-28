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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        @include('layouts.navigation')
    </header>
    @if(session('message'))
    <div class="alert alert-info position-absolute top-50 start-50 translate-middle w-auto" role="alert">
        <p class="m-0 p-0 d-inline-block me-4">{{ session('message') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row justify-content-around m-0">
        <span class="d-inline-block col-auto"></span>
        <div class=" mt-5 col-auto">
            <h1 class="display-5">Welcome to the <span class="text-decoration-underline fs-4">RIGHT</span> place at the <span class="text-decoration-underline fs-4">RIGHT</span> time</h1>
        </div>
    </div>
    <div class="row m-0 mt-5 ms-5">
        <div class="col-auto text-center mt-5">
            <h2 class="display-6 mb-4">Explain your problem to us, we are here to fix it</h2>
            <a href="{{ route('team') }}" class="btn btn-outline border btnMeetTeam">Meet Our Team</a>
        </div>
    </div>
    <div class="row m-0 mt-5 me-5 justify-content-end">
        <div class="col-auto text-center mt-5 me-5">

            <a href="{{ route('register') }}" class="btn btn-outline border btnMeetTeam px-5 rounded-pill me-5 fs-4">Join for free</a>
        </div>
    </div>
    @include('components.footer')

</body>

</html>
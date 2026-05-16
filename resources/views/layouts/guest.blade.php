<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPP') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>

<div class="auth-wrapper"
     style="background-image: url('{{ asset('assets/img/kuruta.png') }}');">

    <!-- Logo -->
    <div class="logo">
        <a href="/">
            <img src="{{ asset('assets/img/kilimanjaro.png') }}"   style="width: 120px; height: 120px; object-fit: contain; border-radius: 50%;
        background: transparent;
    " alt="Logo">
        </a>
    </div>

    <!-- Card -->
    <div class="auth-card">
        {{ $slot }}
    </div>

</div>

</body>
</html>
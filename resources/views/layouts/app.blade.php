<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <header>
        <a href="{{ route('login.show') }}" title="Sign in">Sign in</a>
        <a href="{{ route('register.show') }}" title="Sign up">Sign up</a>
    </header>
    {{ $slot }}
    @livewireScripts
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'ТМС Dealers') }} Авторизация.</title>

    @include('partials.favicons')

    @vite([
        'resources/css/app.css',
    ])
</head>
<body class="bg-neutral-950">
    <!-- Page Content -->
    <main class="w-full min-h-screen flex items-center justify-center">
        {{ $slot }}
    </main>
    <!-- /Page Content -->
</body>
</html>

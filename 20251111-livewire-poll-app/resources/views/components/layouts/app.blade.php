<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Poll App' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
    {{ $slot }}
    @livewireScripts
</body>

</html>

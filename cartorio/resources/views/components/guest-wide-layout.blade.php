<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Cabeçalho fixo com logo -->
    <header class="fixed top-0 w-full bg-white shadow-sm z-50 py-5 px-10 flex justify-center">
        <a href="/">
            <x-application-logo class="w-72 h-20 fill-current" />
        </a>
    </header>

    <!-- Espaço para não sobrepor o conteúdo -->
    <main class="pt-40">
        <div class="max-w-[1100px] mx-auto px-8 py-1 bg-white shadow-md rounded-lg">
            {{ $slot }}
        </div>
    </main>

</body>
</html>

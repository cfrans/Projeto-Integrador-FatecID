<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema Cartório')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('protocolos.index') }}">Protocolos</a>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>

@php $appName = config('app.name', 'Programando Futuros'); @endphp
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            background-color: #1a1a2e; /* mesmo fundo da tela de login */
            height: 100%;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>

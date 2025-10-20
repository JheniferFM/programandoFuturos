@php $appName = config('app.name', 'Programando Futuros'); @endphp
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Estilos globais, fontes e ícones podem estar aqui --}}
</head>
<body>
    @yield('content')
</body>
</html>

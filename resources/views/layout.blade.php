<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Chamadas')</title>
    <script  src = "https://cdn.jsdelivr.net/npm/chart.js" ></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'],'build')
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-700">Página Inicial</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span>Bem-vindo, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-500">Sair</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </div>
</body>
</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">{{ __('Bem-vindo ao Sistema de Chamadas') }}</h1>
                    <p class="mb-6">{{ __("Gerencie suas chamadas de forma fácil e rápida.") }}</p>

                    <!-- Botões de navegação -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if(auth()->user()->hasRole('admin'))
                        <!-- Botão para Gerenciar Usuários -->
                        <a href="{{ route('admin.usuarios.index') }}"
                            class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md">
                            {{ __('Gerenciar Usuários') }}
                        </a>

                        @else
                        <!-- Botão para Criar Nova Chamada -->
                        <a href="{{ route('chamadas.create') }}"
                            class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md">
                            {{ __('Criar Nova Chamada') }}
                        </a>
                        @endif

                        <!-- Botão para Ver Chamadas -->
                        <a href="{{ route('chamadas.index') }}"
                            class="block text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md">
                            {{ auth()->user()->hasRole('admin') ? __('Ver Chamadas') : __('Ver Minhas Chamadas') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
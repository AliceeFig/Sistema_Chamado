<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('admin.usuarios.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            {{ __('Adicionar Novo Usuário') }}
                        </a>

                        <!-- Formulário de busca e filtros -->
                        <form method="GET" action="{{ route('admin.usuarios.index') }}" class="flex items-center space-x-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="{{ __('Buscar por nome...') }}"
                                class="border-gray-300 rounded shadow-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" />

                            <select
                                name="role"
                                class="border-gray-300 rounded shadow-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                                <option value="todos" {{ request('role') === 'todos' ? 'selected' : '' }}>
                                    {{ __('Todos') }}
                                </option>
                                <option value="padrao" {{ request('role') === 'padrao' ? 'selected' : '' }}>
                                    {{ __('Usuários') }}
                                </option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>
                                    {{ __('Administradores') }}
                                </option>
                            </select>

                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                {{ __('Filtrar') }}
                            </button>
                        </form>
                    </div>

                    @if($usuarios->isEmpty())
                    <p class="text-center text-gray-500">{{ __('Nenhum usuário encontrado.') }}</p>
                    @else
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Nome') }}</th>
                                <th class="px-4 py-2">{{ __('Email') }}</th>
                                <th class="px-4 py-2">{{ __('Ações') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td class="border px-4 py-2">{{ $usuario->name }}</td>
                                <td class="border px-4 py-2">{{ $usuario->email }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('admin.usuarios.updateRole', $usuario->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select
                                            name="role"
                                            onchange="this.form.submit()"
                                            class="border-gray-300 rounded shadow-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                                            <option value="padrao" {{ $usuario->hasRole('padrao') ? 'selected' : '' }}>
                                                Usuário
                                            </option>
                                            <option value="admin" {{ $usuario->hasRole('admin') ? 'selected' : '' }}>
                                                Administrador
                                            </option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginação -->
                    <div class="mt-4">
                        {{ $usuarios->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
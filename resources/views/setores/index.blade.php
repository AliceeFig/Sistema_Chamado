<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Gerenciar Setores</h2>

            <!-- Botão Adicionar Setor -->
            <a href="{{ route('setores.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">
                Adicionar Setor
            </a>
        </div>

        <!-- Tabela de Setores -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Nome do Setor</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($setores as $setor)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $setor->nome }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800 flex justify-start space-x-2">
                                <!-- Botão Editar -->
                                <a href="{{ route('setores.edit', $setor->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                                    Editar
                                </a>

                                <!-- Botão Excluir -->
                                <form action="{{ route('setores.destroy', $setor->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>

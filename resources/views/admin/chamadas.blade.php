<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chamadas Pendentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full mt-4 border">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="border px-4 py-2">{{ __('Título') }}</th>
                                <th class="border px-4 py-2">{{ __('Usuário') }}</th>
                                <th class="border px-4 py-2">{{ __('Setor') }}</th>
                                <th class="border px-4 py-2">{{ __('Prioridade') }}</th>
                                <th class="border px-4 py-2">{{ __('Ações') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chamadas as $chamada)
                            <tr>
                                <td class="border px-4 py-2">{{ $chamada->titulo }}</td>
                                <td class="border px-4 py-2">{{ $chamada->user->name }}</td>
                                <td class="border px-4 py-2">{{ $chamada->setor->nome }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($chamada->prioridade) }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('admin.chamadas.atualizar', $chamada->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="border rounded dark:bg-gray-700 dark:text-gray-300">
                                            <option value="pendente">{{ __('Pendente') }}</option>
                                            <option value="em andamento">{{ __('Em Andamento') }}</option>
                                            <option value="concluído">{{ __('Concluído') }}</option>
                                        </select>
                                        <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded">
                                            {{ __('Atualizar') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
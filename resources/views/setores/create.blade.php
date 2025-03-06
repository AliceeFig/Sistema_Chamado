<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Setor') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('setores.store') }}" method="POST">
                @csrf
                <label class="block text-sm font-bold mb-2">Nome do Setor:</label>
                <input type="text" name="nome" class="border rounded w-full p-2" required>

                <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
            </form>
        </div>
    </div>
</x-app-layout>

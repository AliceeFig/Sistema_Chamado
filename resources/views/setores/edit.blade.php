<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Setor') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 mt-6">
        <!-- Formulário de Edição do Setor -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Editar Setor</h2>

            <!-- Formulário -->
            <form action="{{ route('setores.update', $setor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome do Setor</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $setor->nome) }}" class="w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4 text-right">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">
                        Atualizar Setor
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

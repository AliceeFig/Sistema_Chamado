<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Chamada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('chamadas.update', $chamada->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Título') }}
                            </label>
                            <input type="text" name="titulo" id="titulo" value="{{ $chamada->titulo }}"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Descrição') }}
                            </label>
                            <textarea name="descricao" id="descricao" rows="4"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">{{ $chamada->descricao }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="setor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Setor') }}
                            </label>
                            <select name="setor_id" id="setor_id"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                                @foreach($setores as $setor)
                                <option value="{{ $setor->id }}" {{ $chamada->setor_id == $setor->id ? 'selected' : '' }}>
                                    {{ $setor->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="prioridade" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Prioridade') }}
                            </label>
                            <select name="prioridade" id="prioridade"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                                <option value="baixa" {{ $chamada->prioridade == 'baixa' ? 'selected' : '' }}>
                                    {{ __('Baixa') }}
                                </option>
                                <option value="media" {{ $chamada->prioridade == 'media' ? 'selected' : '' }}>
                                    {{ __('Média') }}
                                </option>
                                <option value="alta" {{ $chamada->prioridade == 'alta' ? 'selected' : '' }}>
                                    {{ __('Alta') }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="arquivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Anexo (opcional)') }}
                            </label>
                            <input type="file" name="arquivo" id="arquivo"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm">
                            @if($chamada->arquivo)
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Arquivo atual:') }}
                                <a href="{{ asset('storage/' . $chamada->arquivo) }}" target="_blank"
                                    class="text-blue-500 dark:text-blue-400 hover:underline">
                                    {{ __('Ver Arquivo') }}
                                </a>
                            </p>
                            @endif
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            {{ __('Salvar Alterações') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
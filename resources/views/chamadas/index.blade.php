<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Minhas Chamadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (!Auth::user()->hasRole('admin'))
                    <a href="{{ route('chamadas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
                        {{ __('Nova Chamada') }}
                    </a>
                    @endif

                    {{-- Filtros --}}
                    @if(Auth::user()->hasRole('admin'))
                    <div class="mb-4 flex justify-between items-center">
                        <form method="GET" action="{{ route('chamadas.index') }}" class="flex items-center space-x-2">
                            <select name="status" class="border-gray-300 rounded shadow-sm">
                                <option value="pendente" {{ request('status') === 'pendente' ? 'selected' : '' }}>
                                    {{ __('Pendentes') }}
                                </option>
                                <option value="todas" {{ request('status') === 'todas' ? 'selected' : '' }}>
                                    {{ __('Todas') }}
                                </option>
                            </select>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                {{ __('Filtrar') }}
                            </button>
                        </form>
                    </div>
                    @endif

                    @if($chamadas->isEmpty())
                    <p class="text-center text-gray-500">{{ __('Nenhuma chamada encontrada.') }}</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($chamadas as $chamada)
                        <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg border border-gray-300 overflow-hidden">
                            <!-- Estrutura do Card -->
                            <div class="flex">
                                <!-- Imagem ou Ícone -->
                                <div class="w-1/3 bg-gray-200 relative">
                                    @if($chamada->arquivo)
                                    <!-- Se houver um arquivo, exibe a imagem -->
                                    <img src="{{ asset('storage/' . $chamada->arquivo) }}"
                                        alt="{{ $chamada->titulo }}"
                                        class="h-full w-full object-cover">
                                    @else
                                    <!-- Se não houver arquivo, exibe um ícone -->
                                    <div class="flex justify-center items-center h-full bg-gray-300 text-gray-600">
                                        <i class="fas fa-file-alt text-gray-500 text-4xl"></i>
                                    </div>

                                    @endif
                                </div>

                                <!-- Conteúdo -->
                                <div class="w-2/3 p-4">
                                    <h5 class="font-bold text-lg text-gray-800 dark:text-gray-200 truncate">{{ $chamada->titulo }}</h5>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                                        <strong>{{ __('Setor:') }}</strong> {{ $chamada->setor->nome }}
                                    </p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                                        <strong>{{ __('Prioridade:') }}</strong>
                                        <span class="px-2 py-1 rounded-full
                                                    @if($chamada->prioridade === 'alta') bg-red-500 text-white
                                                    @elseif($chamada->prioridade === 'media') bg-yellow-500 text-white
                                                    @else bg-green-500 text-white @endif">
                                            {{ ucfirst($chamada->prioridade) }}
                                        </span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-3">{{ __('Atualizado: ') . $chamada->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <!-- Botões de Ação -->
                            <div class="p-4 flex flex-wrap gap-2">
                                <a href="{{ route('chamadas.show', $chamada->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded w-full sm:w-auto text-center">
                                    {{ __('Ver Detalhes') }}
                                </a>

                                @if(Auth::id() === $chamada->user_id)
                                <a href="{{ route('chamadas.edit', $chamada->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white text-sm px-4 py-2 rounded w-full sm:w-auto text-center">
                                    {{ __('Editar') }}
                                </a>
                                <form action="{{ route('chamadas.destroy', $chamada->id) }}" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir esta chamada?');" class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-sm px-4 py-2 rounded w-full sm:w-auto text-center">
                                        {{ __('Excluir') }}
                                    </button>
                                </form>
                                @endif

                                @if(Auth::user()->hasRole('admin') && $chamada->status !== 'concluida')
                                <form action="{{ route('chamadas.concluir', $chamada->id) }}" method="POST" onsubmit="return confirm('Tem certeza de que deseja concluir esta chamada?');" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-sm px-4 py-2 rounded w-full sm:w-auto text-center">
                                        {{ __('Concluir') }}
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

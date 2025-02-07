<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes da Chamada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Card Principal -->
                    <div class="card mb-3">
                        @if($chamada->arquivo)
                        <div class="flex space-x-4">
                            <!-- Botão de Visualizar -->
                            <a href="{{ asset('storage/' . $chamada->arquivo) }}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                {{ __('Visualizar Anexo') }}
                            </a>

                            <!-- Botão de Baixar -->
                            <a href="{{ asset('storage/' . $chamada->arquivo) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                                {{ __('Baixar Anexo') }}
                            </a>
                        </div>
                        @else
                        <p class="text-gray-500">{{ __('Nenhum anexo disponível.') }}</p>
                        @endif

                        <div class="card-body mt-4">
                            <h5 class="card-title text-2xl font-semibold">{{ $chamada->titulo }}</h5>
                            <p class="card-text mt-4">
                                <strong>{{ __('Descrição:') }}</strong> {{ $chamada->descricao }}
                            </p>
                            <p class="card-text">
                                <strong>{{ __('Setor:') }}</strong> {{ $chamada->setor->nome }}
                            </p>
                            <p class="card-text">
                                <strong>{{ __('Prioridade:') }}</strong>
                                <span class="px-2 py-1 rounded-full 
                                    @if($chamada->prioridade === 'alta') bg-red-500 text-white
                                    @elseif($chamada->prioridade === 'media') bg-yellow-500 text-white
                                    @else bg-green-500 text-white @endif">
                                    {{ ucfirst($chamada->prioridade) }}
                                </span>
                            </p>
                            <p class="card-text">
                                <strong>{{ __('Status:') }}</strong> {{ ucfirst($chamada->status) }}
                            </p>
                            <p class="card-text mt-4">
                                <small class="text-body-secondary">{{ __('Atualizado: ') . $chamada->updated_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>

                    <!-- Card com imagem na parte inferior -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-2xl font-semibold">{{ __('Informações Adicionais') }}</h5>
                            <p class="card-text mt-4">
                                {{ __('Essa chamada foi registrada por: ') }} <strong>{{ $chamada->usuario->name }}</strong>
                            </p>
                            <p class="card-text">
                                {{ __('Criado em: ') }} <strong>{{ $chamada->created_at->format('d/m/Y H:i') }}</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Botão de Voltar -->
                    <div class="mt-4">
                        <a href="{{ route('chamadas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            {{ __('Voltar para a lista de Chamadas') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
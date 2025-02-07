<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">{{ __('Preencha os dados do novo usuário') }}</h1>

                    <!-- Formulário para criar novo usuário -->
                    <form action="{{ route('admin.usuarios.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">

                            <div>
                                <label for="name" class="block text-sm text-gray-700">{{ __('Nome') }}</label>
                                <input type="text" id="name" name="name" class="mt-1 p-2 w-full rounded bg-gray-100 text-gray-900" value="{{ old('name') }}" required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm text-gray-700">{{ __('Email') }}</label>
                                <input type="email" id="email" name="email" class="mt-1 p-2 w-full rounded bg-gray-100 text-gray-900" value="{{ old('email') }}" required>
                            </div>

                            <div>
                                <label for="password" class="block text-sm text-gray-700">{{ __('Senha') }}</label>
                                <input type="password" id="password" name="password" class="mt-1 p-2 w-full rounded bg-gray-100 text-gray-900" required>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm text-gray-700">{{ __('Confirmar Senha') }}</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 p-2 w-full rounded bg-gray-100 text-gray-900" required>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">
                                    {{ __('Criar Usuário') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
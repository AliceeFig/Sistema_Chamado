<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Esqueceu sua senha? Sem problemas. Informe seu endereço de e-mail e enviaremos um link para redefinição de senha que permitirá criar uma nova.
    </div>

    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Endereço de E-mail -->
        <div>
            <x-input-label for="email" :value="'E-mail'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Enviar link de redefinição de senha
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

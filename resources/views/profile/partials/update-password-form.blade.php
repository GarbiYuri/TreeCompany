<section class="bg-black shadow-md rounded-lg p-6">
    <header>
        <h2 class="text-2xl font-semibold text-white">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="mt-2 text-sm text-white">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para permanecer segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Campo para Senha Atual -->
        <div class="flex flex-col">
            <x-input-label for="update_password_current_password" :value="__('Senha Atual')" class="text-red-700 font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-red-500" />
        </div>

        <!-- Campo para Nova Senha -->
        <div class="flex flex-col">
            <x-input-label for="update_password_password" :value="__('Nova Senha')" class="text-gray-700 font-semibold" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-red-500" />
        </div>

        <!-- Campo para Confirmar Nova Senha -->
        <div class="flex flex-col">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Senha')" class="text-gray-700 font-semibold" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-red-500" />
        </div>

        <!-- Botão Salvar e Notificação -->
        <div class="flex items-center justify-between mt-6">
            <x-primary-button class="bg-success text-white font-bold py-2 px-4 rounded-lg transition ease-in-out duration-200">
                {{ __('Salvar') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-white"
                >
                    {{ __('Senha atualizada com sucesso.') }}
                </p>
            @endif
        </div>
    </form>
</section>

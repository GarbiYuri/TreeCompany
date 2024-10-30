<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Atualização das Informações do Perfil -->
            <div class="p-6 sm:p-8 bg-black shadow-md rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-white mb-4">
                        {{ __('Atualizar Informações do Perfil') }}
                    </h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Alteração de Senha -->
            <div class="p-6 sm:p-8 bg-black shadow-md rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-white mb-4">
                        {{ __('Atualizar Senha') }}
                    </h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Excluir Conta -->
            <div class="p-6 sm:p-8 bg-black shadow-md rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">
                        {{ __('Excluir Conta') }}
                    </h3>
                    <p class="text-sm text-white mb-4">
                        {{ __('Uma vez que sua conta for excluída, todos os seus dados serão permanentemente removidos. Por favor, certifique-se de que deseja continuar.') }}
                    </p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</x-app-layout>

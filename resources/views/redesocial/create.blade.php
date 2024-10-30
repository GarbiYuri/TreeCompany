<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Nova Rede Social') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white text-center">
                            <h4 class="mb-0">Criar Rede Social</h4>
                        </div>
                        <div class="card-body">
                            <!-- Formulário para Criar Rede Social -->
                            <form action="{{ route('redesocial.store') }}" method="POST">
                                @csrf

                                <!-- Campo oculto para enviar o ID da empresa automaticamente -->
                                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

                                <!-- Nome da Rede Social -->
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome da Rede Social</label>
                                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex: Facebook, Instagram" required>
                                </div>

                                <!-- Link da Rede Social -->
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link da Rede Social</label>
                                    <input type="url" name="link" id="link" class="form-control" placeholder="https://www.rede.com/perfil" required>
                                </div>

                                <!-- Botão de Enviar -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> Criar Rede Social
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos Customizados -->
    <style>
        .form-label {
            font-weight: bold;
        }

        .card {
            border-radius: 0.75rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-lg {
            padding: 0.75rem 1.25rem;
            font-size: 1.25rem;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>

    <!-- Adicionando Font Awesome para Ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</x-app-layout>

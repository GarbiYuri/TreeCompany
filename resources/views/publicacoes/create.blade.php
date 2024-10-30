<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Publicação') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white text-center">
                            <h4 class="mb-0">Criar Publicação</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('publicacoes.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Campo oculto para enviar o ID da empresa automaticamente -->
                                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

                                <!-- Campo para Título da Publicação -->
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Digite o título da publicação" required>
                                </div>

                                <!-- Campo para Conteúdo da Publicação -->
                                <div class="mb-3">
                                    <label for="conteudo" class="form-label">Conteúdo</label>
                                    <textarea name="conteudo" id="conteudo" class="form-control" placeholder="Digite o conteúdo da publicação" rows="6" required></textarea>
                                </div>

                                <!-- Campo para anexar arquivos -->
                                <div class="mb-3">
                                    <label for="imagens" class="form-label">Anexar Imagens</label>
                                    <input type="file" name="imagens[]" id="imagens" class="form-control" multiple accept="image/*">
                                </div>

                                <!-- Botão de Enviar -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane"></i> Criar Publicação
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

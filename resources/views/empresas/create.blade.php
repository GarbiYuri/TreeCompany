<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitação para Criar ou Editar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white text-center">
                            <h4 class="mb-0">Solicitação para Criar Empresa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('empresas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="NOME" class="form-label">Nome da Empresa</label>
                                    <input type="text" name="NOME" id="NOME" class="form-control" placeholder="Digite o nome da empresa" value="{{ $empresa->NOME ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="CNPJ" class="form-label">CNPJ</label>
                                    <input type="text" name="CNPJ" id="CNPJ" class="form-control" placeholder="Digite o CNPJ" maxlength="14" value="{{ $empresa->CNPJ ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="form-control" placeholder="Descreva a empresa" rows="4" oninput="contarCaracteres()" maxlength="255" required>{{ $empresa->descricao ?? '' }}</textarea>
                                    <!-- Exibe a contagem de caracteres -->
                                <div id="contador">0/255 caracteres</div>
                                </div>

                                <div class="mb-3">
                                    <label for="categoria_id" class="form-label">Categoria</label>
                                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                                        <option value="" disabled {{ isset($empresa) ? '' : 'selected' }}>Selecione uma Categoria</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ isset($empresa) && $empresa->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Campo de upload para a logo da empresa -->
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo da Empresa</label>
                                    @if(isset($empresa->logo))
                                        <div class="mb-2">
                                            <p>Logo Atual:</p>
                                            <img src="{{ asset('logos/' . $empresa->logo) }}" alt="Logo Atual" class="img-fluid mb-2" style="max-width: 150px;">
                                        </div>
                                    @endif
                                    <input type="file" name="logo" id="logo" class="form-control" accept=".jpeg, .jpg, .png, .gif">
                                    <div id="mensagem-erro" style="color: red;"></div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane"></i> {{ isset($empresa) ? 'Atualizar Empresa' : 'Solicitar Aprovação' }}
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

    <script>
        function contarCaracteres() {
        // Seleciona o textarea
        var textarea = document.getElementById('descricao');
        // Conta o número de caracteres
        var length = textarea.value.length;
        // Atualiza o contador
        
        if(length < 255){
            document.getElementById('contador').innerText = length + '/255 caracteres';
        }else{
            document.getElementById('contador').innerText = 'Limite Atingido!';
        }
        

        
    }
    document.getElementById('logo').addEventListener('change', function() {
        // Obtém o arquivo selecionado
        var file = this.files[0];
        // Obtém a div de mensagem de erro
        var mensagemErro = document.getElementById('mensagem-erro');
        // Limpa mensagens de erro anteriores
        mensagemErro.textContent = '';

        if (file) {
            // Obtém a extensão do arquivo
            var fileExtension = file.name.split('.').pop().toLowerCase();
            // Lista de extensões permitidas
            var allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];

            // Verifica se a extensão é permitida
            if (!allowedExtensions.includes(fileExtension)) {
                // Exibe mensagem de erro
                mensagemErro.textContent = 'Formato de arquivo inválido! Permitido: jpeg, jpg, png, gif.';
                // Limpa o campo de arquivo
                this.value = '';
            }
        }
    });

    // Inicializa a contagem ao carregar a página
    contarCaracteres();
    </script>
    <!-- Adicionando Font Awesome para Ícones 
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/js/all.min.js" crossorigin="anonymous"></script>
-->
</x-app-layout>

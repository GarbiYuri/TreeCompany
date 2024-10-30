<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel da Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark p-0">
        <div class="container">
            <!-- Painel da Empresa -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h1 class="mb-0">Painel de Administração</h1>
                        </div>
                        <div class="card-body p-5">
                            <!-- Formulário para editar dados da empresa -->
                            <form action="{{ route('empresas.update', $empresa->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card shadow-sm border-0 p-3">
                                            <label for="NOME" class="form-label">Nome da Empresa</label>
                                            <input type="text" name="NOME" value="{{ $empresa->NOME ?? '' }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card shadow-sm border-0 p-3">
                                            <label for="CNPJ" class="form-label">CNPJ</label>
                                            <input type="text" name="CNPJ" maxlength="14" value="{{ $empresa->CNPJ ?? '' }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 card shadow-sm border-0 p-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="4"
                                        oninput="contarCaracteres()" maxlength="255"
                                        required>{{ $empresa->descricao ?? '' }}</textarea>
                                    <!-- Exibe a contagem de caracteres -->
                                    <div id="contador">0/255 caracteres</div>
                                </div>

                        </div>

                        <div class="row mb-4">
                            <!-- Campo para exibir logo atual e alterar logo -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 p-3">
                                    <label for="logo" class="form-label">Logo da Empresa</label>
                                    @if(isset($empresa->logo))
                                        <div class="mb-2 text-center">
                                            <p>Logo Atual:</p>
                                            <img src="{{ asset('logos/' . $empresa->logo) }}" alt="Logo Atual"
                                                class="img-fluid mb-2" style="max-width: 150px;">
                                            <p>Alterar Logo:</p>
                                        </div>
                                    @endif
                                    <input type="file" name="logo" id="logo" class="form-control"
                                        accept=".jpeg, .jpg, .png, .gif">

                                    <div id="mensagem-erro" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-lg btn-success shadow-sm">
                                    <i class="fas fa-save"></i> Atualizar Dados
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <!-- Botão para adicionar nova publicação e Rede Social -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Redes Sociais</h3>
                    <a href="{{ route('redesocial.create', $empresa->id) }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Adicionar Rede Social
                    </a>
                </div>

                @if($empresa->redesSociais->isNotEmpty())
                    @foreach($empresa->redesSociais as $index => $redesocial)
                        <a class="card-text d-flex align-items-center" href="{{ $redesocial->link ?? '#' }}" target="_blank"
                            style="text-decoration: none; color: inherit;">
                            <i class="fab fa-{{ strtolower($redesocial->nome) }} me-2" aria-hidden="true"></i>
                            <h5 class="card-title mb-0">{{ $redesocial->nome ?? 'Sem Nome' }}</h5>
                        </a>

                        <!-- Botões de editar e excluir -->
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('redesocial.edit', $redesocial->id) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('redesocial.destroy', $redesocial->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir esta publicação?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p class="alert alert-warning">Nenhuma Rede Social.</p>
                @endif

            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Publicações</h3>
                    <a href="{{ route('publicacoes.create', $empresa->id) }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Adicionar Nova Publicação
                    </a>
                </div>


                @if($empresa->publicacoes->isNotEmpty())
                    @foreach($empresa->publicacoes as $index => $publicacao)
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $publicacao->titulo ?? 'Sem título' }}</h5>
                                <p class="card-text">{{ $publicacao->conteudo ?? 'Sem conteúdo' }}</p>

                                <!-- Botões de editar e excluir -->
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('publicacoes.edit', $publicacao->id) }}"
                                        class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('publicacoes.destroy', $publicacao->id) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir esta publicação?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </button>
                                    </form>
                                </div>

                                <!-- Galeria de imagens da publicação -->
                                @if($publicacao->imagens && $publicacao->imagens->count() > 1)
                                    <div id="carousel{{ $index }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($publicacao->imagens as $key => $imagem)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $imagem->caminho_imagem) }}" class="d-block w-100"
                                                        alt="Imagem da Publicação">
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Controles de navegação da galeria -->
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $index }}"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Anterior</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $index }}"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Próximo</span>
                                        </button>
                                    </div>
                                @elseif($publicacao->imagens && $publicacao->imagens->count() == 1)
                                    <!-- Exibir apenas a imagem se houver uma única imagem -->
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/' . $publicacao->imagens->first()->caminho_imagem) }}"
                                            class="d-block w-100" alt="Imagem da Publicação">
                                    </div>
                                @else

                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="alert alert-warning">Ainda não há publicações.</p>
                @endif
            </div>
        </div>

        <!-- Estilos customizados -->
        <style>
            h1 {
                font-size: 2rem;
                font-weight: 700;
            }

            .form-label {
                font-weight: 600;
            }

            .btn {
                margin-top: 10px;
            }

            .table-hover tbody tr:hover {
                background-color: #f1f1f1;
            }

            .table-light {
                background-color: #f8f9fa;
            }

            .table .fas.fa-star {
                margin-right: 2px;
            }

            .alert-info {
                background-color: #d1ecf1;
                color: #0c5460;
                padding: 10px;
                border-radius: 5px;
            }

            .card {
                border-radius: 0.75rem;
                margin-bottom: 1.5rem;
            }

            .btn-success {
                background-color: #28a745;
                border-color: #28a745;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }

            .card-header {
                border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            }

            /* Ajustando a imagem para não cortar e não distorcer */
            .carousel-item img {
                height: 400px;
                object-fit: contain;
                /* Mostra a imagem completa sem cortar nem distorcer */
                background-color: #f8f9fa;
                /* Adiciona fundo cinza para imagens menores */
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                background-color: black;
            }
        </style>
        <script>
            function contarCaracteres() {
                // Seleciona o textarea
                var textarea = document.getElementById('descricao');
                // Conta o número de caracteres
                var length = textarea.value.length;
                // Atualiza o contador

                if (length < 255) {
                    document.getElementById('contador').innerText = length + '/255 caracteres';
                } else {
                    document.getElementById('contador').innerText = 'Limite Atingido!';
                }



            }

            document.getElementById('logo').addEventListener('change', function () {
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
        <!-- Adicionando Font Awesome para os ícones 
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    -->
</x-app-layout>
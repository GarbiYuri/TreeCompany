<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil da Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row">
                <!-- Informações da Empresa (Fixo à esquerda) -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 position-sticky" style="top: 20px;">
                        <div class="card-body d-flex flex-column align-items-center text-center">
                            <!-- Logo da Empresa -->
                            @if($empresa->logo)
                                <img src="{{ asset('logos/' . $empresa->logo) }}" alt="Logo da Empresa"
                                    class="img-fluid mb-4" style="max-height: 150px; border-radius: 50%; margin: 0 auto;">
                            @else
                                <img src="{{ asset('img/default-logo.png') }}" alt="Logo Padrão" class="img-fluid mb-4"
                                    style="max-height: 150px; border-radius: 50%; margin: 0 auto;">
                            @endif

                            <!-- Nome da Empresa -->
                            <h3 class="card-title" style="font-size: 1.75rem; font-weight: bold;">{{ $empresa->NOME }}
                            </h3>

                            <!-- Verificação de Selo de Biosustentabilidade -->
                            @if($empresa->biosustentavel)
                                <div class="mb-3">
                                    <img src="{{ asset('img/Biosustentavel.jpg') }}" alt="Selo Biosustentável"
                                        class="img-fluid" style="max-height: 50px; margin: 0 auto;">
                                    <p class="text-success mt-2"><strong>Empresa Biosustentável</strong></p>
                                </div>
                            @else
                                <div class="mb-3">
                                    <img src="{{ asset('img/naoconfirmado.jpg') }}" alt="Selo Não Confirmado"
                                        class="img-fluid" style="max-height: 50px; margin: 0 auto;">
                                    <p class="text-danger mt-2"><strong>Empresa não confirmada no selo
                                            Biosustentável</strong></p>
                                </div>
                            @endif

                            <!-- Informações Adicionais -->
                            <p class="mb-1"><strong>CNPJ:</strong> {{ $empresa->CNPJ }}</p>
                            <p class="mb-1"><strong>Categoria:</strong>
                                {{ $empresa->categoria->nome ?? 'Sem Categoria' }}</p>
                            <p class="mb-3"><strong>Descrição:</strong> {{ $empresa->descricao }}</p>

                            <!-- Avaliação Média -->
                            <div class="mb-3">
                                <h4>Avaliação</h4>
                                @php
                                    $mediaEstrelas = $empresa->avaliacoes->avg('estrelas'); // Média das estrelas
                                @endphp
                                <div class="d-flex justify-content-center align-items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i <= $mediaEstrelas ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                    <span class="ms-2">({{ number_format($mediaEstrelas, 1) }} / 5)</span>

                                </div>
                                <!-- Botão de Denúncia -->
                                <div class="mt-3">
                                    <a href="{{ route('denuncias.create', $empresa->id) }}"
                                        class="btn btn-danger">
                                        <i class="fas fa-exclamation-triangle"></i> Denunciar Empresa
                                    </a>
                                </div>
                            </div>
                @if($empresa->redesSociais->isNotEmpty())
                    @foreach($empresa->redesSociais as $index => $redesocial)
                        <a class="card-text d-flex align-items-center" href="{{ $redesocial->link ?? '#' }}" target="_blank"
                            style="text-decoration: none; color: inherit;">
                            <i class="fab fa-{{ strtolower($redesocial->nome) }} me-2" aria-hidden="true"></i>
                            <h5 class="card-title mb-0">{{ $redesocial->nome ?? 'Sem Nome' }}</h5>
                        </a>
                    @endforeach
                @else
                    <p class="alert alert-warning">Nenhuma Rede Social.</p>
                @endif
                        </div>
                    </div>
                </div>

                <!-- Abas para Publicações e Avaliações -->
                <div class="col-md-8">
                    <!-- Navegação em Abas -->
                    <ul class="nav nav-tabs mb-4" id="empresaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="publicacoes-tab" data-bs-toggle="tab"
                                data-bs-target="#publicacoes" type="button" role="tab" aria-controls="publicacoes"
                                aria-selected="true">
                                <i class="fas fa-image"></i> Publicações
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="avaliacoes-tab" data-bs-toggle="tab"
                                data-bs-target="#avaliacoes" type="button" role="tab" aria-controls="avaliacoes"
                                aria-selected="false">
                                <i class="fas fa-star"></i> Avaliações
                            </button>
                        </li>
                    </ul>

                    <!-- Conteúdo das Abas -->
                    <div class="tab-content" id="empresaTabsContent">
                        <!-- Abas de Publicações -->
                        <div class="tab-pane fade show active" id="publicacoes" role="tabpanel"
                            aria-labelledby="publicacoes-tab">
                            @if($empresa->publicacoes->isNotEmpty())
                                <div class="row">
                                    @foreach($empresa->publicacoes as $publicacao)
                                        <div class="col-md-6 mb-4">
                                            <div class="card shadow-sm border-0">
                                                <div class="card-body p-4">
                                                    <!-- Título da Publicação -->

                                                    <h5 class="card-title mb-3" style="font-size: 1.5rem; font-weight: bold;">
                                                        {{ $publicacao->titulo }}
                                                    </h5>

                                                    @if($publicacao->imagens->isNotEmpty())
                                                        <div id="carousel{{ $publicacao->id }}" class="carousel slide mb-3"
                                                            data-bs-ride="carousel">
                                                            <div class="carousel-inner">
                                                                @foreach($publicacao->imagens as $key => $imagem)
                                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                        <img src="{{ asset('storage/' . $imagem->caminho_imagem) }}"
                                                                            class="d-block w-100" alt="Imagem da Publicação"
                                                                            style="max-height: 400px; object-fit: cover;">
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <!-- Exibir setas apenas se houver mais de uma imagem -->
                                                            @if($publicacao->imagens->count() > 1)
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#carousel{{ $publicacao->id }}"
                                                                    data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Anterior</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#carousel{{ $publicacao->id }}"
                                                                    data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Próximo</span>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @else
                                                        
                                                    @endif

                                                    <!-- Conteúdo da Publicação -->
                                                    <p class="mt-2">{{ $publicacao->conteudo }}</p>
                                                    <p class="text-muted mt-2"><small>Publicado
                                                            {{ $publicacao->created_at->diffForHumans() }}</small></p>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="alert alert-warning">Ainda não há publicações desta empresa.</p>
                            @endif
                        </div>

                        <!-- Aba de Avaliações -->
                        <div class="tab-pane fade" id="avaliacoes" role="tabpanel" aria-labelledby="avaliacoes-tab">
                            @if($empresa->avaliacoes->isNotEmpty())
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Avaliações</h4>
                                        <ul class="list-group list-group-flush">
                                            @foreach($empresa->avaliacoes as $avaliacao)
                                                <li class="list-group-item d-flex align-items-start">
                                                    <div>
                                                        <!-- Nome do Usuário -->
                                                        <strong>{{ $avaliacao->user->name }}</strong>
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <!-- Estrelas da Avaliação -->
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fas fa-star {{ $i <= $avaliacao->estrelas ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                            <span class="ms-2">({{ $avaliacao->estrelas }} / 5)</span>
                                                        </div>

                                                        <p class="mt-2">{{ $avaliacao->descricao }}</p>

                                                        <!-- Exibir a foto da avaliação, se houver -->
                                                        @if($avaliacao->foto)
                                                            <div class="mt-3">
                                                                <img src="{{ asset('storage/' . $avaliacao->foto) }}"
                                                                    alt="Foto da Avaliação" class="img-fluid rounded"
                                                                    style="max-height: 200px;">
                                                            </div>
                                                        @endif

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <p class="alert alert-info">Esta empresa ainda não possui avaliações.</p>
                            @endif
                        </div>

                        <!-- Estilos customizados -->
                        <style>
                            .img-fluid {
                                max-width: 100%;
                                height: auto;
                            }

                            .card-title {
                                font-size: 1.5rem;
                                font-weight: bold;
                            }

                            .carousel-item img {
                                object-fit: cover;
                                background-color: #f8f9fa;
                            }

                            .carousel-control-prev-icon,
                            .carousel-control-next-icon {
                                background-color: black;
                            }

                            .btn {
                                margin-top: 10px;
                            }

                            .rounded-circle {
                                border-radius: 50%;
                            }

                            .card {
                                border-radius: 1rem;
                            }

                            .position-sticky {
                                position: -webkit-sticky;
                                position: sticky;
                                top: 20px;
                            }

                            .nav-tabs .nav-link {
                                color: #333;
                            }

                            .nav-tabs .nav-link.active {
                                color: #000;
                                font-weight: bold;
                                border-color: #dee2e6 #dee2e6 #fff;
                            }

                            .tab-content {
                                margin-top: 20px;
                            }
                        </style>

                        <!-- Adicionando Font Awesome para ícones -->
                        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</x-app-layout>
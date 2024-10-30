<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row">
                <!-- Conteúdo principal -->
                <main>
                    <div class="pt-3 pb-2 mb-3 border-bottom border-secondary">
                        <!-- Barra de pesquisa -->
                        <form action="{{ route('empresas.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control bg-white text-dark" name="search"
                                    value="{{ request()->input('search') }}" placeholder="Pesquisar pelo Nome..."
                                    aria-label="Pesquisar" aria-describedby="button-search">
                                <button class="btn btn-outline-dark" type="submit" id="button-search">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </form>

                        <!-- Navbar Superior de Ordenação -->
                        <nav class="navbar navbar-expand-lg bg-light p-3 mb-4 rounded-lg shadow-sm">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" style="display:none;"
                                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-wrap">
                                        <li class="nav-item me-2">
                                            <a class="nav-link text-dark font-weight-bold" href="?sort=name_asc">
                                                <i class="fas fa-sort-alpha-up"></i> Ordem Alfabética ↑
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link text-dark font-weight-bold" href="?sort=name_desc">
                                                <i class="fas fa-sort-alpha-down"></i> Ordem Alfabética ↓
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link text-dark font-weight-bold" href="?sort=rating_desc">
                                                <i class="fas fa-star"></i> Mais Bem Avaliado ↑
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link text-dark font-weight-bold" href="?sort=rating_asc">
                                                <i class="fas fa-star-half-alt"></i> Menos Bem Avaliado ↓
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!-- Listagem de Empresas em formato de Cartão -->
                        <div class="row">
                            @if($empresas->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    Nenhuma empresa encontrada para a pesquisa de NOME: "{{ $search }}"
                                </div>
                            @else
                                @foreach($empresas as $empresa)
                                    <div class="col-md-4">
                                        <!-- Cartão da empresa como um botão clicável -->
                                        <a href="{{ route('empresas.show', $empresa->id) }}" class="card-link">
                                            <div class="card mb-4 shadow-sm card-hover">
                                                <div class="card-img-container">
                                                    <!-- Exibe a logo da empresa, se houver -->
                                                    @if($empresa->logo)
                                                        <img src="{{ asset('logos/' . $empresa->logo) }}" alt="Logo da Empresa"
                                                            class="img-fluid card-img">
                                                    @else
                                                        <img src="{{ asset('img/default-logo.png') }}" alt="Empresa Sem Logo"
                                                            class="img-fluid card-img">
                                                    @endif
                                                </div>

                                                <div class="card-body">
                                                    <!-- Nome da empresa -->
                                                    <h5 class="card-title">{{ $empresa->NOME }}</h5>

                                                    <!-- Descrição da empresa -->
                                                    <p class="card-text">{{ Str::limit($empresa->descricao, 100) }}</p>

                                                    <!-- Avaliação média -->
                                                    <div class="mb-2">
                                                        <div class="d-inline">
                                                            @php
                                                                $mediaEstrelas = $empresa->avaliacoes->avg('estrelas');

        
                                                            @endphp
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fas fa-star {{ $i <= $mediaEstrelas ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                            <span class="ms-2">({{ number_format($mediaEstrelas, 1) }} /
                                                                5)</span>
                                                            <p><strong>Avaliações:</strong> {{ $empresa->avaliacoes->count() }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Número de publicações -->
                                                    <p><strong>Publicações:</strong> {{ $empresa->publicacoes->count() }}</p>

                                                    <!-- Botões Ver Avaliações e Avaliar -->
                                                    <div class="d-flex justify-content-between mt-4">
                                                        <a href="{{ route('empresas.avaliacoes.index', $empresa->id) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Ver Avaliações
                                                        </a>
                                                        <a href="{{ route('empresas.avaliacoes.create', $empresa->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-star"></i> Avaliar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Estilos Customizados -->
    <style>
        .card {
            border-radius: 0.5rem;
            background-color: #181818;
            color: white;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .card-hover:hover {
            background-color: #292929;
            transform: scale(1.05);
        }

        .card-link {
            text-decoration: none;
        }

        .card-img-container {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .card-img {
            object-fit: contain;
            width: 100%;
            height: 100%;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            margin-top: 0.5rem;
        }

        .btn {
            margin-top: 1rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        /* Estilos para tornar os botões de ordenação responsivos */
        @media (max-width: 576px) {
            .navbar-nav {
                flex-direction: column;
                width: 100%;
            }

            .navbar-nav .nav-item {
                margin-bottom: 0.5rem;
                width: 100%;
            }
        }
    </style>

</x-app-layout>

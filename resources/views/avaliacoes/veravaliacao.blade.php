<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row">
                <!-- Conteúdo principal -->
                <main>
                    <div class="pt-3 pb-2 mb-3 border-bottom border-secondary text-center">
                        <h3 class="text-center font-weight-bold mb-4">Avaliações da Empresa</h3>

                        @if($avaliacoes && $avaliacoes->isNotEmpty())
                            @foreach($avaliacoes as $avaliacao)
                                <div class="card mb-4 shadow-sm">
                                    
                                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                     <!-- Exibe o nome do usuário apenas se a avaliação não for anônima -->
                                     @if($avaliacao->id_user)
                                            <p class="mt-3 text-light">Avaliado por: {{ $avaliacao->user->name }}</p>
                                        @else
                                            <p class="mt-3 text-light">Avaliação Anônima</p>
                                        @endif    
                                    <span>{{ $empresa->nome }}</span>
                                        <span class="badge bg-warning text-dark">{{ $avaliacao->estrelas }} <i class="fas fa-star"></i></span>
                                    </div>
                                    <div class="card-body">
                                        <!-- Exibe a foto da avaliação, se houver -->
                                        @if($avaliacao->foto)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $avaliacao->foto) }}" alt="Foto da Avaliação" class="img-fluid" style="max-width: 300px; height: auto;">
                                            </div>
                                        @endif

                                        <!-- Exibe a descrição da avaliação -->
                                        <p class="mb-0">{{ $avaliacao->descricao }}</p>

                                       
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{ route('empresas.avaliacoes.edit', [$empresa->id, $avaliacao->id]) }}" class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('empresas.avaliacoes.destroy', [$empresa->id, $avaliacao->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Deletar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                Nenhuma avaliação encontrada para esta empresa.
                            </div>
                        @endif

                        <a href="{{ route('empresas.avaliacoes.create', $empresa->id) }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle"></i> Adicionar Nova Avaliação
                        </a>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Estilos customizados -->
    <style>
        .card-header .badge {
            font-size: 1rem;
        }

        .btn-sm {
            font-size: 0.875rem;
            padding: 0.25rem 0.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .card {
            border-radius: 0.5rem;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>

    <!-- Importando Font Awesome para os ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</x-app-layout>

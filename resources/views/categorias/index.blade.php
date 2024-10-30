<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row">
                <main class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h4">Categorias</h1>

                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Adicionar Categoria
                        </a>
                        @endif
                    </div>

                    <div class="card shadow-sm border-secondary">
                        <div class="card-body">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        @if(auth()->user()->isAdmin())
                                        <th scope="col" class="text-center">Ações</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorias as $categoria)
                                        <tr>
                                            <th scope="row">{{ $categoria->id }}</th>
                                            <!-- Nome da categoria como botão estilizado -->
                                            <td>
                                                <a href="{{ route('categorias.empresas', $categoria->id) }}" class="btn btn-category">
                                                    {{ $categoria->nome }}
                                                </a>
                                            </td>
                                            @if(auth()->user()->isAdmin())
                                            <td class="text-center">
                                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning me-1">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Deletar
                                                    </button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Estilos adicionais para ajuste de cores e layout -->
    <style>
        /* Estilo do botão de categoria */
        .btn-category {
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: 2px solid #007bff;
            padding: 0.5rem 1rem;
            border-radius: 30px; /* Bordas arredondadas para um visual mais suave */
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s ease; /* Transição suave para hover */
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3); /* Sombra suave */
        }

        .btn-category:hover {
            background-color: #0056b3; /* Cor de fundo mais escura ao passar o mouse */
            border-color: #0056b3; /* Cor da borda mais escura */
            box-shadow: 0 6px 15px rgba(0, 86, 179, 0.4); /* Sombra mais forte ao passar o mouse */
            color: #fff;
            text-decoration: none;
        }

        .btn-category:active {
            background-color: #003f7f; /* Cor mais escura ao clicar */
            border-color: #003f7f;
            box-shadow: inset 0 4px 8px rgba(0, 63, 127, 0.4); /* Sombra interna ao clicar */
        }

        /* Estilo para a tabela */
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
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

        .table-dark {
            background-color: #343a40;
            color: white;
        }

        .table-dark th, .table-dark td {
            vertical-align: middle;
        }
    </style>

    <!-- Importando Font Awesome para os ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</x-app-layout>

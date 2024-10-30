<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Usuários e Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark p-0">
        <div class="container-fluid">
            <div class="row">
                <!-- Conteúdo principal -->
                <main>
                    <div class="pt-3 pb-2 mb-3 border-bottom border-secondary">
                        <!-- Barra de pesquisa -->
                        <form action="{{ route('userencontrado') }}" method="GET" style="display:none;">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control bg-white text-dark" name="search" value="{{ request()->input('search') }}" placeholder="Pesquisar pelo Nome..." aria-label="Pesquisar" aria-describedby="button-search">
                                <button class="btn btn-outline-dark" type="submit" id="button-search">Buscar</button>
                            </div>
                        </form>

                        <!-- Listagem de Usuários -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Administrador</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->administrador)
                                                    <span class="badge bg-success">Sim</span>
                                                @else
                                                    <span class="badge bg-danger">Não</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Formulário para Tornar Administrador -->
                                                @if(!$user->administrador)
                                                    <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-warning">
                                                            Tornar Admin
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Formulário para Remover Administrador -->
                                                @if($user->administrador)
                                                    <form action="{{ route('admin.desmakeAdmin', $user->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-secondary">
                                                            Remover Admin
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Formulário para Deletar Conta -->
                                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        Deletar Conta
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Listagem de Empresas -->
                        <div class="pt-3 pb-2 mb-3 border-bottom border-secondary">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome da Empresa</th>
                                            <th>CNPJ</th>
                                            <th>Categoria</th>
                                            <th>Biosustentável</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empresas as $empresa)
                                            <tr>
                                                <td>{{ $empresa->NOME }}</td>
                                                <td>{{ $empresa->CNPJ }}</td>
                                                <td>{{ $empresa->categoria->nome ?? 'Sem Categoria' }}</td>
                                                <td>
                                                    @if($empresa->biosustentavel)
                                                        <span class="badge bg-success">Sim</span>
                                                    @else
                                                        <span class="badge bg-danger">Não</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Botão para tornar biosustentável -->
                                                    <form action="{{ route('empresas.biosustentavel', $empresa->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        @if($empresa->biosustentavel)
                                                            <button class="btn btn-sm btn-warning">
                                                                Remover Biosustentável
                                                            </button>
                                                        @else
                                                            <button class="btn btn-sm btn-success">
                                                                Tornar Biosustentável
                                                            </button>
                                                        @endif
                                                    </form>

                                                    <!-- Botão de Editar -->
                                                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-sm btn-primary">Editar</a>

                                                    <!-- Formulário para Deletar Empresa -->
                                                    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">Deletar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
 <!-- Botão para visualizar denúncias -->
 <div class="pt-3 pb-2 mb-3">
                            <a href="{{ route('denuncias.index') }}" class="btn btn-danger">
                                <i class="fas fa-exclamation-circle"></i> Ver Denúncias
                            </a>
                        </div>
                        <!-- Sistema de Chat -->
                        <div class="card mt-4 bg-light text-dark border-secondary" style="display:none;">
                            <div class="card-header border-secondary">
                                <h5 class="card-title mb-0">Chat</h5>
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </div>
                            <div class="card-body">
                                <div class="message mb-3">
                                    <div class="alert alert-secondary text-dark" role="alert">
                                        Olá! Como podemos ajudar?
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-white text-dark" placeholder="Digite uma mensagem...">
                                    <button class="btn btn-primary" type="button">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

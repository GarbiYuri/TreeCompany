<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Usuários e Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            @if(auth()->user()->isAdmin())
            <!-- Tabela de Solicitações Pendentes -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title mb-0">Solicitações Pendentes</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CNPJ</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empresasPendentes as $empresa)
                                <tr>
                                    <td>{{ $empresa->NOME }}</td>
                                    <td>{{ $empresa->CNPJ }}</td>
                                    <td>{{ $empresa->descricao }}</td>
                                    <td>
                                        <form action="{{ route('empresas.aprovar', $empresa->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Aprovar
                                            </button>
                                        </form>

                                        <!-- Botão de Não Aprovar (Excluir Empresa) -->
                                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Não Aprovar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Exibir Mensagens de Sucesso/Erro -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulário de Vinculação de Usuário à Empresa -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">Vincular Usuário à Empresa</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('userempresa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Selecionar Usuário:</label>
                <select name="user_id" class="form-control" required>
                    <option value="" disabled selected>Selecione um usuário</option>
                    @foreach($users as $user)
                        @if(!$user->empresa) <!-- Exibe apenas usuários não vinculados -->
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="empresa_id" class="form-label">Selecionar Empresa:</label>
                <select name="empresa_id" class="form-control" required>
                    <option value="" disabled selected>Selecione uma empresa</option>
                    @foreach($empresas as $empresa)
                        @if(!$empresa->user) <!-- Exibe apenas empresas sem usuário vinculado -->
                            <option value="{{ $empresa->id }}">{{ $empresa->NOME }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-2">
                <i class="fas fa-link"></i> Vincular Usuário à Empresa
            </button>
        </form>
    </div>
</div>


           <!-- Tabela de Usuários e Empresas Vinculadas -->
<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
        <h3 class="card-title mb-0">Usuários Vinculados a Empresas</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome do Usuário</th>
                    <th>Email</th>
                    <th>Nome da Empresa</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($user->empresa) <!-- Exibe apenas usuários vinculados -->
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->empresa->NOME }}</td>
                            <td>
                                <!-- Botão para Desvincular Usuário da Empresa -->
                                <form action="{{ route('userempresa.desvincular', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('POST') <!-- Método para ação de desvinculação -->
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-unlink"></i> Desvincular
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

        </div>
    </div>
</x-app-layout>

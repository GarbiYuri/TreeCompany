<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark p-0">
        <div class="container-fluid">
            <div class="row">
                <!-- Conteúdo principal -->
                <main>
                    <div class="pt-3 pb-2 mb-3 border-bottom border-secondary">
                        <!-- Barra de pesquisa -->
                        <form action="{{ route('index2') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control bg-white text-dark" name="search" value="{{ request()->input('search') }}" placeholder="Pesquisar pelo Nome..." aria-label="Pesquisar" aria-describedby="button-search">
                                <button class="btn btn-outline-dark" type="submit" id="button-search">Buscar</button>
                            </div>
                        </form>

                        <!-- Listagem de Empresas e Pessoas -->
                        <div class="container">
        <a href="{{ route('empresas.create') }}" class="btn btn-primary">Adicionar Empresa</a>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>CNPJ</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->id }}</td>
                        <td>{{ $empresa->NOME }}</td>
                        <td>{{ $empresa->CNPJ }}</td>
                        <td>{{ $empresa->descricao }}</td>
                        <td>
                            <a href="{{ route('empresas.show', $empresa->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

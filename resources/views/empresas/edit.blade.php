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
                        <!-- Formulário de Edição de Empresa -->
                        <div class="container">
                            <form action="{{ route('empresas.update', $empresa->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Campo Nome -->
                                <div class="mb-3">
                                    <label for="NOME" class="form-label">Nome da Empresa</label>
                                    <input type="text" name="NOME" class="form-control" value="{{ $empresa->NOME }}" required>
                                </div>

                                <!-- Campo CNPJ -->
                                <div class="mb-3">
                                    <label for="CNPJ" class="form-label">CNPJ</label>
                                    <input type="text" name="CNPJ" class="form-control" value="{{ $empresa->CNPJ }}" required>
                                </div>

                                <!-- Campo Descrição -->
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" class="form-control" required>{{ $empresa->descricao }}</textarea>
                                </div>

                                <!-- Campo para alterar a Logo da empresa -->
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo da Empresa</label>
                                    @if(isset($empresa->logo))
                                        <div class="mb-2">
                                            <p>Logo Atual:</p>
                                            <img src="{{ asset('logos/' . $empresa->logo) }}" alt="Logo Atual" class="img-fluid mb-2" style="max-width: 150px;">
                                        </div>
                                    @endif
                                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                                </div>

                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </form>
                        </div>

                        <!-- Publicações da Empresa -->
                        <div class="mt-5">
                            <h3>Publicações da Empresa</h3>
                            @if($empresa->publicacoes->isNotEmpty())
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Conteúdo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empresa->publicacoes as $publicacao)
                                            <tr>
                                                <td>{{ $publicacao->titulo }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($publicacao->conteudo, 50) }}</td>
                                                <td>
                                                    <!-- Botões para Editar e Deletar Publicações -->
                                                    <a href="{{ route('publicacoes.edit', $publicacao->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                    <form action="{{ route('publicacoes.destroy', $publicacao->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="alert alert-warning">Esta empresa ainda não possui publicações.</p>
                            @endif
                            <a href="{{ route('publicacoes.create', $empresa->id) }}" class="btn btn-success">Adicionar Nova Publicação</a>
                        </div>
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
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

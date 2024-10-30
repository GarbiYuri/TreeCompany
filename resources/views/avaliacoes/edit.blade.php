

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
                    <h1>Editar Avaliação da Empresa: {{ $empresa->nome }}</h1>

<!-- Exibe erros de validação, se houver -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Formulário de Edição de Avaliação -->
<form action="{{ route('empresas.avaliacoes.update', [$empresa->id, $avaliacao->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição da Avaliação</label>
        <textarea name="descricao" id="descricao" class="form-control" required>{{ old('descricao', $avaliacao->descricao) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="estrelas" class="form-label">Avaliação em Estrelas (1 a 5)</label>
        <input type="number" name="estrelas" id="estrelas" class="form-control" min="1" max="5" required value="{{ old('estrelas', $avaliacao->estrelas) }}">
    </div>

    <button type="submit" class="btn btn-primary">Atualizar Avaliação</button>
    <a href="{{ route('empresas.avaliacoes.index', $empresa->id) }}" class="btn btn-secondary">Voltar</a>
</form>

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

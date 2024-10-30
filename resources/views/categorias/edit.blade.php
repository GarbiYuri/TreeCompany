<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem de Empresas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark p-0">
        <div class="container-fluid">
            <div class="row">
                <!-- Conteúdo principal -->
                <main>
                    <div class="pt-3 pb-2 mb-3 border-bottom border-secondary">
                        <!-- Barra de pesquisa -->
                <form action="{{ route('empresas.index') }}" method="GET">
                <div class="input-group mb-3">
                <input type="text" class="form-control bg-white text-dark" name="search" value="{{ request()->input('search') }}" placeholder="Pesquisar pelo Nome..." aria-label="Pesquisar" aria-describedby="button-search">
            <button class="btn btn-outline-dark" type="submit" id="button-search">Buscar</button>
        </div>
            </form>

            <h1>Editar Categoria</h1>

<form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input type="text" name="nome" class="form-control" id="nome" value="{{ $categoria->nome }}" required>
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
</form>

        
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

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
                        

    


    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" name="nome" class="form-control" id="nome" required>
        </div>
        <button type="submit" class="btn btn-success">Criar</button>
    </form>


        
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

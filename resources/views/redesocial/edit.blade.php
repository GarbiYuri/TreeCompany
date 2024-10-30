<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Rede Social') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white text-center">
                            <h4 class="mb-0">Editar Rede Social</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('redesocial.update', $redeSocial->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Nome da Rede Social -->
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome da Rede Social</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="{{ $redeSocial->nome }}" required>
                                </div>

                                <!-- Link da Rede Social -->
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link da Rede Social</label>
                                    <input type="url" name="link" id="link" class="form-control" value="{{ $redeSocial->link }}" required>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> Atualizar Rede Social
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

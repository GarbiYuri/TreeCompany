<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Publicação') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white text-center">
                            <h4 class="mb-0">Editar Publicação</h4>
                        </div>
                        <div class="card-body">
                             <!-- Imagens atuais da publicação -->
                             @if($publicacao->imagens->isNotEmpty())
                                    <div class="mb-3">
                                        <label for="imagens" class="form-label">Imagens Atuais</label>
                                        <div class="row">
                                            @foreach($publicacao->imagens as $imagem)
                                                <div class="col-md-4 text-center">
                                                    <img src="{{ asset('storage/' . $imagem->caminho_imagem) }}" class="img-fluid mb-2" style="max-height: 150px; object-fit: contain;">
                                                    <!-- Botão para remover imagem -->
                                                    <form action="{{ route('imagens.destroy', $imagem->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta imagem?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            <form action="{{ route('publicacoes.update', $publicacao->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Título da Publicação -->
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $publicacao->titulo }}" required>
                                </div>

                                <!-- Conteúdo da Publicação -->
                                <div class="mb-3">
                                    <label for="conteudo" class="form-label">Conteúdo</label>
                                    <textarea name="conteudo" id="conteudo" class="form-control" rows="6" required>{{ $publicacao->conteudo }}</textarea>
                                </div>

                               
                                <!-- Upload de novas imagens -->
                                <div class="mb-3">
                                    <label for="novas_imagens" class="form-label">Substituir ou Adicionar Imagens</label>
                                    <input type="file" name="imagens[]" id="novas_imagens" class="form-control" multiple accept="image/*">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> Atualizar Publicação
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

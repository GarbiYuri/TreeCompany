<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Avaliar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row">
                <!-- Conteúdo principal -->
                <main>
                    <div class="pt-3 pb-2 mb-3 border-bottom border-secondary">
                        <h3>Avaliar Empresa</h3>

                        <!-- Formulário de Avaliação -->
                        <form action="{{ route('empresas.avaliacoes.store', [$empresaId]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Campo Descrição -->
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" name="descricao" id="descricao" class="form-control" required>
                            </div>

                            <!-- Avaliação de Estrelas -->
                            <div class="mb-3">
                                <label for="estrelas" class="form-label">Avaliação</label>
                                <div class="star-rating">
                                    <input type="hidden" name="estrelas" id="estrelas" value="0">
                                    <i class="fas fa-star" data-rating="1"></i>
                                    <i class="fas fa-star" data-rating="2"></i>
                                    <i class="fas fa-star" data-rating="3"></i>
                                    <i class="fas fa-star" data-rating="4"></i>
                                    <i class="fas fa-star" data-rating="5"></i>
                                </div>
                            </div>
                           
                            <!-- Avaliação Anônima -->
                            <div class="form-check mb-3" style="display:none;">
                                <input type="checkbox" class="form-check-input" id="anonimo" name="anonimo">
                                <label class="form-check-label" for="anonimo">Avaliar Anonimamente</label>
                            </div>
                           
                            <!-- Upload de Foto (Beta) -->
                            <div class="mb-3">
                                <label for="foto" class="form-label">Adicionar Foto (Beta)</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>

                            <!-- Botão Enviar -->
                            <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Estilos customizados -->
    <style>
        .star-rating .fa-star {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
        }
        .star-rating .fa-star.checked {
            color: #ffc107;
        }
    </style>

    <!-- Importar Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Script de interatividade -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star-rating .fa-star');
            const ratingInput = document.getElementById('estrelas');

            stars.forEach(star => {
                star.addEventListener('mouseover', function () {
                    const rating = this.getAttribute('data-rating');
                    highlightStars(rating);
                });

                star.addEventListener('mouseout', function () {
                    const currentRating = ratingInput.value;
                    highlightStars(currentRating);
                });

                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;
                    highlightStars(rating);
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-rating') <= rating) {
                        star.classList.add('checked');
                    } else {
                        star.classList.remove('checked');
                    }
                });
            }
        });
    </script>
</x-app-layout>

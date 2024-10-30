<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitação para Criar ou Editar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-light text-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white text-center">
                        <h2>Denunciar Empresa: {{ $empresa->NOME }}</h2>
    
    <form action="{{ route('denuncias.store') }}" method="POST">
        @csrf
        <!-- Campo oculto para enviar o ID da empresa -->
        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

        <div class="mb-3">
            <label for="descricao" class="form-label">Motivo da Denúncia</label>
            <textarea name="descricao" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-danger">Enviar Denúncia</button>
    </form>
</div>
</form>

    <!-- Estilos Customizados -->
    <style>
        .form-label {
            font-weight: bold;
        }

        .card {
            border-radius: 0.75rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-lg {
            padding: 0.75rem 1.25rem;
            font-size: 1.25rem;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>

    <!-- Adicionando Font Awesome para Ícones -->
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/js/all.min.js" crossorigin="anonymous"></script>

</x-app-layout>

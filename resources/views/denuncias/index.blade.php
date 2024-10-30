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
                    <h1>Lista de Denúncias</h1>



<table class="table mt-4">
    <thead>
        <tr>
            <th>#</th>
            <th>Empresa</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($denuncias as $denuncia)
            <tr>
                <td>{{ $denuncia->id }}</td>
                <td>{{ $denuncia->empresa->NOME }}</td>
                <td>{{ $denuncia->descricao }}</td>
                <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('denuncias.destroy', $denuncia->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>

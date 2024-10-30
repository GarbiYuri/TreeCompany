<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Three Company</title>
        
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('icon.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- CSS do Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- JS do Bootstrap (necessário para funcionalidades como dropdowns e modais) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
/* Defina uma transição suave para todas as propriedades que mudam no hover */
.link-hover {
    transition: all 0.3s ease-in-out;
    position: relative;
}

/* Quando o usuário passa o mouse sobre o link */
.link-hover:hover {
    background-color: rgba(255, 255, 255, 0.1); /* Cor de fundo suave no hover */
    transform: scale(1.05); /* Aumenta o tamanho suavemente */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Adiciona sombra suave */
}

/* Animação ao clicar */
.link-hover:active {
    transform: scale(0.95); /* Efeito de clique */
}

/* Efeito de foco para acessibilidade */
.link-hover:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5); /* Destaque no foco */
}

/* Adicionando animação suave ao ícone no hover */
.link-hover i {
    transition: transform 0.3s ease-in-out;
}

.link-hover:hover i {
    transform: rotate(15deg); /* Gira o ícone ligeiramente no hover */
}
</style>
    </head>
    
    <body class="font-sans antialiased">
    
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @if (isset($header))
               
            @endif

            <!-- Page Content -->
            <main >
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

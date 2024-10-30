<x-app-layout>
    <style>
        /* Estilos gerais */
        body, .min-h-screen {
            background-color: #000 !important; /* Fundo preto para a tela inteira */
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex; /* Define o display como flex */
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            height: 100vh; /* Altura total da tela */
            flex-direction: column; /* Coloca os elementos em coluna */
        }

        /* Estilos do container */
        .container {
            margin-top: 20px;
            background-color: #fff; /* Fundo do quadrado branco */
            width: 90%; /* Largura do quadrado */
            max-width: 600px; /* Largura máxima do quadrado */
            padding: 40px; /* Espaçamento interno */
            border-radius: 10px; /* Bordas arredondadas */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra para dar profundidade */
            text-align: center; /* Centraliza o texto */
        }

        h1 {
            color: #ff0000;
            margin: 0 0 20px 0;
        }

        p {
            color: #000;
            line-height: 1.6; /* Melhora a legibilidade do texto */
            text-align: justify; /* Justifica o texto */
        }

        /* Estilos do link do Instagram */
        .instagram-link-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .instagram-link {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
            display: flex;
            align-items: center;
        }

        .instagram-link i {
            margin-right: 8px; /* Espaçamento entre o ícone e o texto */
        }
    </style>

    <!-- Container Principal -->
    <div class="container">
        <h1>Sobre Nós</h1>
        <p>Three Company é um projeto criado para a feira de ciências FECEETEC da Etec Euro Albino de Souza, com o objetivo de conectar empresas contratantes e prestadoras de serviços terceirizados. A plataforma online funciona como uma rede social voltada para o ambiente corporativo, onde empresas podem se cadastrar, expor seus serviços e serem verificadas pela equipe do projeto, garantindo mais segurança e confiança nas negociações.</p>
        <p>A proposta promove a eficiência na busca por fornecedores e serviços, incentivando práticas mais sustentáveis dentro do mercado. A plataforma está em fase de desenvolvimento, já operando com funcionalidade básica, e será apresentada nos dias 22 e 23 de outubro.</p>
    </div>

    <!-- Link para o Instagram -->
    <div class="instagram-link-container">
        <a href="https://www.instagram.com/threecompany.2024/" class="instagram-link" target="_blank">
            <i class="fab fa-instagram"></i> @threecompany.2024
        </a>
    </div>

    <!-- Importar Font Awesome para ícones -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-Fo3rlrZj/kTcXpoDZde6z+VqzQeXj5c4M6VR3wimH7gD1Tcft2x3z+hgQ6eFg+VuI1qfr6+9l9VsCf1vT81x1Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</x-app-layout>

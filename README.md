# TreeCompany


Este projeto foi desenvolvido originalmente para uma Feira de Ciências, com o objetivo de criar uma rede social focada em auditoria e marketing empresarial. A plataforma permite que usuários cadastrem empresas, avaliem serviços e encontrem parceiros para melhorar o posicionamento de mercado.
💡 O Conceito

A ideia surgiu da necessidade de pequenas empresas terem um feedback real sobre seu marketing. O sistema funciona como uma ponte:

    Avaliação: Empresas recebem notas e feedbacks sobre sua comunicação visual e atendimento.

    Networking: Funciona como uma vitrine para encontrar serviços locais.

    Melhoria Contínua: Fornece dados para que o gestor saiba onde investir no marketing.

🛠️ Tecnologias Utilizadas

O projeto utiliza a Stack Monolítica Moderna, garantindo velocidade de desenvolvimento e uma experiência de SPA (Single Page Application):

    Back-end: Laravel 10+ (PHP)

    Front-end: React.js

    Ponte de Dados: Inertia.js (Elimina a necessidade de criar uma API REST separada, permitindo usar roteamento do Laravel no React)

    Banco de Dados: MySQL

    Estilização: Tailwind CSS 

🌟 Principais Funcionalidades

    [x] Cadastro de Empresas: Perfil completo com descrição e nicho de mercado.

    [x] Sistema de Feedbacks: Usuários podem avaliar o marketing e os serviços prestados.

    [x] Feed Social: Lista de empresas cadastradas com filtros de busca.

    [x] Painel Administrativo: Gestão de cadastros e moderação de avaliações.

🔧 Como Rodar o Projeto

Para rodar este projeto localmente, você precisará do PHP, Composer e Node.js instalados.

    Clone o repositório:
    Bash

    git clone https://github.com/seu-usuario/nome-do-repo.git

    Instale as dependências do PHP:
    Bash

    composer install

    Instale as dependências do Front-end:
    Bash

    npm install

    Configure o ambiente:

        Renomeie o arquivo .env.example para .env

        Configure as credenciais do seu banco de dados MySQL no .env.

    Gere a chave da aplicação e rode as migrações:
    Bash

    php artisan key:generate
    php artisan migrate

    Inicie os servidores:

        Em um terminal: php artisan serve

        Em outro terminal: npm run dev

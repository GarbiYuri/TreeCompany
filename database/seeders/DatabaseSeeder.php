<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Avaliacao;
use App\Models\Publicacao;
use App\Models\FotoPubli;
use App\Models\Categoria; // Adiciona a importação do modelo Categoria
use Illuminate\Support\Facades\Hash; // Adiciona a importação do Hash

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Cria um usuário administrador específico
        User::factory()->create([
            'name' => 'ThreeCompany',
            'email' => 'threecompany@gmail.com',
            'password' => Hash::make('Manosbrpt1720'), // Usa Hash::make para hashear a senha
            'administrador' => 1, // Define como administrador
        ]);
      
        // Cria categorias
        Categoria::create(['nome' => 'Tecnologia']);
        Categoria::create(['nome' => 'Saúde']);
        Categoria::create(['nome' => 'Educação']);
        Categoria::create(['nome' => 'Alimentação']);
        Categoria::create(['nome' => 'Transportes']);
    
        // Se você tiver outros seeders, pode chamá-los aqui
        // Exemplo: $this->call(EmpresaSeeder::class);
        // Recupera todas as categorias criadas
        $categorias = Categoria::all();

         // Criação de alguns usuários
         $user1 = User::create([
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'password' => Hash::make('password')
        ]);

        $user2 = User::create([
            'name' => 'Maria Souza',
            'email' => 'maria@example.com',
            'password' => Hash::make('password')
        ]);

        // Criação de algumas empresas vinculadas aos usuários
        $empresa1 = Empresa::create([
            'NOME' => 'TechVision',
            'CNPJ' => '12345678901234',
            'descricao' => 'TechVision é uma empresa líder em inovação tecnológica e sustentabilidade.',
            'categoria_id' => 1, // Suponha que 1 seja o ID de uma categoria válida
            'biosustentavel' => true, // Empresa com selo de Biosustentabilidade
            'user_id' => $user1->id,
            'logo' => 'techvision_logo.png', // Caminho fictício do logo
        ]);

        $empresa2 = Empresa::create([
            'NOME' => 'GreenTech Solutions',
            'CNPJ' => '98765432109876',
            'descricao' => 'GreenTech é pioneira em soluções tecnológicas sustentáveis para empresas.',
            'categoria_id' => 2, // Outra categoria válida
            'biosustentavel' => false, // Empresa sem selo de Biosustentabilidade
            'user_id' => $user2->id,
            'logo' => 'greentech_logo.png',
        ]);

        // Criação de algumas avaliações para as empresas
        Avaliacao::create([
            'id_empresa' => $empresa1->id,
            'id_user' => $user2->id,
            'estrelas' => 5,
            'descricao' => 'A TechVision oferece um serviço excepcional e suas soluções são verdadeiramente inovadoras!'
        ]);

        Avaliacao::create([
            'id_empresa' => $empresa2->id,
            'id_user' => $user1->id,
            'estrelas' => 4,
            'descricao' => 'A GreenTech está realmente no caminho certo, mas poderia investir mais em inovação.'
        ]);

        // Criação de algumas publicações para as empresas
        $publicacao1 = Publicacao::create([
            'empresa_id' => $empresa1->id,
            'titulo' => 'Inovação Sustentável: O Futuro é Agora',
            'conteudo' => 'Na TechVision, acreditamos que o futuro sustentável passa por tecnologias inovadoras. Saiba mais sobre nossas iniciativas verdes.'
        ]);

        $publicacao2 = Publicacao::create([
            'empresa_id' => $empresa2->id,
            'titulo' => 'Tecnologia Verde para Empresas',
            'conteudo' => 'GreenTech Solutions traz novas tecnologias para empresas que buscam se tornar mais sustentáveis.'
        ]);

        // Adicionar algumas imagens às publicações
        FotoPubli::create([
            'publicacao_id' => $publicacao1->id,
            'caminho_imagem' => 'publicacoes/techvision_publicacao1.png'
        ]);

        FotoPubli::create([
            'publicacao_id' => $publicacao2->id,
            'caminho_imagem' => 'publicacoes/greentech_publicacao1.png'
        ]);

        FotoPubli::create([
            'publicacao_id' => $publicacao2->id,
            'caminho_imagem' => 'publicacoes/greentech_publicacao2.png'
        ]);
    

        
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Criação da tabela 'empresa'
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('NOME');
            $table->string('CNPJ');
            $table->string('descricao');
            $table->string('status')->default('pendente'); // Definir o valor padrão corretamente
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable(); // Permitir que 'categoria_id' seja nulo

            // Coluna para o caminho da logo
            $table->string('logo')->nullable(); // Caminho da imagem da logo, pode ser nulo

            // Coluna para verificar se a empresa é biosustentável
            $table->boolean('biosustentavel')->default(false); // Valor padrão é 'false', empresa não verificada como biosustentável

            // Coluna para o botão de contato (link para um número de telefone, e-mail ou outra forma de contato)
            $table->string('contato')->nullable(); // Pode ser nulo, caso a empresa não tenha contato

            // Coluna para o link de rede social (link para uma rede social)
            $table->string('rede_social')->nullable(); // Pode ser nulo, caso a empresa não tenha rede social

            // Definir chave estrangeira para 'categoria_id'
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categoria')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Definir chave estrangeira para 'user_id'
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null'); // Caso o usuário seja excluído, a coluna será nula
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Apaga a tabela 'empresa'
        Schema::dropIfExists('empresa');
    }
};

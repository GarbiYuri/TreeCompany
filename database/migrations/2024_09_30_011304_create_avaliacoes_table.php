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
        Schema::create('avaliacao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_user')->nullable(); // Permite que o campo seja nulo (caso seja necessário)
            $table->string('descricao');
            $table->integer('estrelas')->unsigned();
            $table->string('foto')->nullable(); // Campo para armazenar o caminho da foto (nullable)

            // Chave estrangeira para a tabela 'empresa'
            $table->foreign('id_empresa')
                  ->references('id') // Refere-se ao campo 'id' na tabela 'empresa'
                  ->on('empresa')
                  ->onDelete('cascade') // Exclui as avaliações ao excluir a empresa
                  ->onUpdate('cascade'); // Atualiza a chave estrangeira se o 'id' da empresa mudar

            // Chave estrangeira para a tabela 'users'
            $table->foreign('id_user')
                  ->references('id') // Refere-se ao campo 'id' na tabela 'users'
                  ->on('users')
                  ->onDelete('cascade') // Exclui as avaliações ao excluir o usuário
                  ->onUpdate('cascade'); // Atualiza a chave estrangeira se o 'id' do usuário mudar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao');
    }
};

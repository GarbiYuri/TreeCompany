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
        // Criação da tabela 'fotopubli'
        Schema::create('fotopubli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publicacao_id'); // Chave estrangeira para a publicação
            $table->string('caminho_imagem'); // Campo para armazenar o caminho da imagem
            $table->timestamps();

            // Definir a chave estrangeira
            $table->foreign('publicacao_id')
                  ->references('id')
                  ->on('publicacao') // Nome da tabela de publicações
                  ->onDelete('cascade'); // Excluir fotos se a publicação for excluída
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotopubli');
    }
};

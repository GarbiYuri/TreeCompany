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
        Schema::create('denuncia', function (Blueprint $table) {
            $table->id();
            
            // Referência para a tabela de empresas (chave estrangeira)
            $table->foreignId('empresa_id')->constrained('empresa')->onDelete('cascade');
            
            // Campo de texto para a denúncia
            $table->text('descricao');
            
            // Timestamps para criação e atualização
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncia');
    }
};

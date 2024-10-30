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
        Schema::create('redesocial', function (Blueprint $table) {
            $table->id();
            
            // Chave estrangeira para empresas
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('cascade');

            // Nome da Rede Social
            $table->string('nome', 255);
            
            // Link da Rede Social
            $table->string('link', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redesocial');
    }
};

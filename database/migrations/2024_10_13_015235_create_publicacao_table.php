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
        Schema::create('publicacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id'); // Chave estrangeira
            $table->string('titulo');
            $table->text('conteudo');
            $table->timestamps();

            // Define a chave estrangeira para 'empresa_id'
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresa')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacao');
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna id_empresa e define como chave estrangeira
            $table->unsignedBigInteger('id_empresa')->nullable(); // Pode ser nullable se não for obrigatório
            $table->foreign('id_empresa')
                  ->references('id') // Referencia a coluna id da tabela empresas
                  ->on('empresa')   // Nome da tabela que está sendo referenciada
                  ->onDelete('set null') // Caso a empresa seja excluída, define o campo como null
                  ->onUpdate('cascade'); // Atualiza a empresa de forma cascata
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna id_empresa
            $table->dropForeign(['id_empresa']);
            $table->dropColumn('id_empresa');
        });
    }
};

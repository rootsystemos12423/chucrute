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
        Schema::table('checkouts', function (Blueprint $table) {
            // Adiciona a coluna store_id
            $table->unsignedBigInteger('store_id')->nullable();

            // Cria a chave estrangeira
            $table->foreign('store_id')
                  ->references('id') // Coluna da tabela 'stores'
                  ->on('users_checkout_stores') // Tabela de referência
                  ->onDelete('cascade'); // Comportamento ao deletar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna
            $table->dropForeign(['store_id']);
            $table->dropColumn('store_id');
        });
    }
};

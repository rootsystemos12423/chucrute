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
        Schema::table('cart_items', function (Blueprint $table) {
            // Adicionando a coluna is_bump (boolean com valor default false)
            $table->boolean('is_bump')->default(false);

            // Adicionando a coluna bump_id (chave estrangeira para order_bumps)
            $table->unsignedBigInteger('bump_id')->nullable();

            // Definindo a chave estrangeira
            $table->foreign('bump_id')->references('id')->on('order_bumps')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Remover a chave estrangeira
            $table->dropForeign(['bump_id']);
            
            // Remover as colunas
            $table->dropColumn(['is_bump', 'bump_id']);
        });
    }
};

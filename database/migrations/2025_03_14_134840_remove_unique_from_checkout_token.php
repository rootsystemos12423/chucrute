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
        Schema::table('checkout_orders', function (Blueprint $table) {
            // Remover a restrição unique da coluna checkout_token
            $table->dropUnique('checkout_orders_checkout_token_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkout_orders', function (Blueprint $table) {
            // Caso você queira reverter, pode adicionar a restrição unique novamente
            $table->unique('checkout_token');
        });
    }
};

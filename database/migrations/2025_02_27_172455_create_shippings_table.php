<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade');
            $table->string('name'); // Nome do envio
            $table->decimal('price', 10, 2)->nullable(); // Valor do frete
            $table->integer('min_delivery_days')->nullable(); // Dias mínimos para entrega
            $table->integer('max_delivery_days')->nullable(); // Dias máximos para entrega
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status do frete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};

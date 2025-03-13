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
        Schema::create('checkouts_payment_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade');
            $table->string('payment_method'); // Ex: "PIX", "Cartão de Crédito", etc.
            $table->decimal('discount_percentage', 5, 2); // Ex: 5.00 para 5%
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts_payment_discount');
    }
};

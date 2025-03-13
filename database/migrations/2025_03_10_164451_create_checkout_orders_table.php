<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('checkout_orders', function (Blueprint $table) {
            $table->id(); // ID do pedido
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade'); // Relacionado à loja
            $table->string('payment_method');
            $table->string('checkout_token')->unique(); // Token do checkout
            $table->string('status')->default('pending'); // Status do pedido (pending, paid, shipped, etc.)
            $table->bigInteger('total_value'); // Valor total em centavos
            $table->integer('installments')->nullable(); // Número de parcelas
            $table->json('customer_data'); // Dados do cliente (nome, email, telefone)
            $table->json('items'); // Produtos do pedido
            $table->json('shipping_data'); // Dados do frete (endereço, preço, prazo)
            $table->json('payment_data')->nullable(); // Dados do pagamento
            $table->string('external_reference')->nullable(); // Referência externa (ID do gateway de pagamento)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_orders');
    }
};

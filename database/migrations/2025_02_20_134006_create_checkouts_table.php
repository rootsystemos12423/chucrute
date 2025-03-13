<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            // Referência ao carrinho associado, cujos itens estão na tabela cart_items
            $table->string('cart_token');
            $table->string('shop_domain');
            $table->string('customer_email')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_taxId')->nullable();
            $table->string('customer_telphone')->nullable();
            $table->json('customer_shipping_address')->nullable();
            $table->integer('subtotal_price')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('total_discount')->default(0);
            $table->string('currency', 3)->nullable();
            $table->json('payment_details')->nullable();
            $table->timestamps();

            // Chave estrangeira para associar a loja
            $table->foreign('shop_domain')
                  ->references('shopify_url')
                  ->on('shops')
                  ->onDelete('cascade');

            // Chave estrangeira para associar o checkout ao carrinho
            $table->foreign('cart_token')
                  ->references('token')
                  ->on('carts')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};

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
        Schema::create('store_products_shopify_checkout', function (Blueprint $table) {
            $table->id(); // Criação da coluna id como chave primária
            $table->unsignedBigInteger('product_id')->unique(); // Definindo product_id como único
            $table->string('title');
            $table->text('body_html')->nullable();
            $table->string('vendor')->nullable();
            $table->string('product_type')->nullable();
            $table->timestamp('created_at_shopify')->nullable();
            $table->timestamp('updated_at_shopify')->nullable();
            $table->string('handle')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('template_suffix')->nullable();
            $table->string('published_scope')->nullable();
            $table->string('tags')->nullable();
            $table->string('status')->nullable();
            $table->string('admin_graphql_api_id')->nullable();
            $table->json('variants')->nullable();
            $table->json('options')->nullable();
            $table->json('images')->nullable();
            $table->json('image')->nullable();
        
            // Adicionando a chave estrangeira
            $table->unsignedBigInteger('user_checkout_store_id'); // Referência para a tabela users_checkout_stores
            $table->foreign('user_checkout_store_id')->references('id')->on('users_checkout_stores')->onDelete('cascade'); // Relacionamento com a tabela users_checkout_stores
        
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products_shopify_checkout');
    }
};

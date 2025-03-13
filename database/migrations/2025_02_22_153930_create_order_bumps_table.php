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
        Schema::create('order_bumps', function (Blueprint $table) {
            $table->id();
            
            // A coluna store_id deve ser unsignedBigInteger para compatibilidade com a chave primária
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('users_checkout_stores')->onDelete('cascade');
        
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('store_products_shopify_checkout')->onDelete('cascade');
        
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->string('status')->default('active');
        
            $table->timestamps();
        });                 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_bumps', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('cart_token');
            $table->unsignedBigInteger('variant_id');
            $table->integer('quantity');
            $table->string('title');
            $table->integer('price');
            $table->integer('original_price');
            $table->integer('discounted_price');
            $table->integer('line_price');
            $table->string('sku')->nullable();
            $table->integer('grams');
            $table->string('vendor');
            $table->boolean('taxable');
            $table->unsignedBigInteger('product_id');
            $table->string('url');
            $table->string('image');
            $table->string('handle');
            $table->json('featured_image');
            $table->json('options_with_values');
            $table->json('discounts')->nullable();
            $table->timestamps();

            $table->foreign('cart_token')
                ->references('token')
                ->on('carts')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

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
        Schema::create('carts', function (Blueprint $table) {
            $table->string('token')->primary();
            $table->string('shop');
            $table->text('note')->nullable();
            $table->json('attributes')->nullable();
            $table->integer('original_total_price');
            $table->integer('total_price');
            $table->integer('total_discount')->default(0);
            $table->integer('total_weight')->default(0);
            $table->integer('item_count');
            $table->boolean('requires_shipping');
            $table->string('currency', 3);
            $table->integer('items_subtotal_price');
            $table->json('cart_level_discount_applications')->nullable();
            $table->timestamps();

            $table->foreign('shop')
                ->references('shopify_url')
                ->on('shops')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

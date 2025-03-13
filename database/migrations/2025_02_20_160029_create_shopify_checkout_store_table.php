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
        Schema::create('shopify_checkout_store', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade'); // Relacionamento com stores
            $table->string('shopify_url');
            $table->string('shopify_api_token');
            $table->string('shopify_api_key');
            $table->string('shopify_api_secret');
            $table->boolean('skip_cart')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopify_checkout_store');
    }
};

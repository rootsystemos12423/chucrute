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
        Schema::create('apps_utmify', function (Blueprint $table) {
            $table->id();
            $table->string('utmify_api_key', 255);
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade'); // Relacionado à loja
            $table->boolean('status')->default(true);
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps_utmify');
    }
};

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
        Schema::create('google_ads_pixels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade'); // Relacionado à loja
            $table->string('conversion_id');
            $table->string('conversion_label');
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('send_event_pix')->default(false);
            $table->boolean('send_event_bankslip')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('google_ads_pixels');
    }
};

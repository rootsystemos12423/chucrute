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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('users_checkout_stores')->onDelete('cascade'); // Relacionado à loja
            $table->string('name'); // Nome do gateway (ex: Pay2Win)
            $table->string('client_id');
            $table->string('secret_key');
            $table->boolean('enable_credit_card')->default(true);
            $table->boolean('enable_pix')->default(true);
            $table->boolean('enable_boleto')->default(false);
            $table->boolean('enable_custom_interest_rate')->default(false);
            $table->decimal('additional_interest_rate', 5, 2)->nullable();
            $table->enum('interest_rule', ['all', 'none'])->default('all');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};

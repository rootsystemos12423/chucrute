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
        Schema::table('checkouts', function (Blueprint $table) {
            $table->unsignedBigInteger('frete_id')->nullable()->after('id');
            $table->foreign('frete_id')->references('id')->on('shippings')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropForeign(['frete_id']);
            $table->dropColumn('frete_id');
        });
    }
};

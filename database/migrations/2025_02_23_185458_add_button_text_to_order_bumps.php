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
        Schema::table('order_bumps', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('description');
        });
    }


    public function down(): void
    {
        Schema::table('order_bumps', function (Blueprint $table) {
            $table->dropColumn('button_text'); // Remove a coluna em caso de rollback
        });
    }
};

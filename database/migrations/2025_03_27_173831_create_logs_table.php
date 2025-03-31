<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->text('message');          // Mensagem de erro completa
            $table->string('exception');      // Tipo da exceção (ex: Exception::class)
            $table->unsignedInteger('code');  // Código do erro (HTTP status code)
            $table->text('trace');            // Stack trace completo
            $table->string('file');           // Arquivo onde ocorreu o erro
            $table->unsignedInteger('line');  // Linha do arquivo
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('request_uri');      // URL que gerou o erro
            $table->string('request_method'); // Método HTTP (GET, POST, etc)
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            // Índices para consultas rápidas
            $table->index('exception');
            $table->index('code');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};

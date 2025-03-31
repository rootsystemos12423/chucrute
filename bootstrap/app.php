<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (Throwable $e) {
            try {
                // Verificação redundante para garantir que a tabela existe
                if (\DB::connection()->getDatabaseName() && Schema::hasTable('logs')) {
                    \App\Jobs\LogErrorJob::dispatchSync(
                        $e->getMessage(),
                        get_class($e),
                        $e->getCode(),
                        $e->getTraceAsString(),
                        $e->getFile(),
                        $e->getLine(),
                        optional(auth())->id(),
                        request()->getRequestUri(),
                        request()->method(),
                        request()->userAgent(),
                        request()->ip()
                    );
                } else {
                    \Log::channel('single')->error('Tabela logs não disponível: '.$e->getMessage());
                }
            } catch (\Throwable $loggingError) {
                \Log::channel('single')->error('Erro no handler: '.$loggingError->getMessage());
            }
        });
    })->create();
<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use App\Models\Log;

class ErrorLogger extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        $exception = $record['context']['exception'] ?? null;
        
        if ($exception instanceof \Throwable) {
            Log::create([
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'code' => $exception->getCode(),
                'trace' => $exception->getTraceAsString(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'user_id' => auth()->id(),
                'request_uri' => request()->getRequestUri(),
                'request_method' => request()->method(),
                'user_agent' => request()->userAgent(),
                'ip_address' => request()->ip()
            ]);
        }
    }
}
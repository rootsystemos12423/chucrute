<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class LogErrorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $message,
        private string $exception,
        private int $code,
        private string $trace,
        private string $file,
        private int $line,
        private ?int $userId,
        private string $requestUri,
        private string $requestMethod,
        private ?string $userAgent,
        private ?string $ipAddress
    ) {}

    public function handle()
    {
        \App\Models\Log::create([
            'message' => $this->message,
            'exception' => $this->exception,
            'code' => $this->code,
            'trace' => $this->trace,
            'file' => $this->file,
            'line' => $this->line,
            'user_id' => $this->userId,
            'request_uri' => $this->requestUri,
            'request_method' => $this->requestMethod,
            'user_agent' => $this->userAgent,
            'ip_address' => $this->ipAddress,
        ]);
    }
}
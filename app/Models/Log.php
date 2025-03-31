<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'exception',
        'code',
        'trace',
        'file',
        'line',
        'user_id',
        'request_uri',
        'request_method',
        'user_agent',
        'ip_address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'integer',
        'line' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with User model
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar por tipo de exceção
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('exception', $type);
    }

    /**
     * Scope para filtrar por código de erro
     */
    public function scopeWithCode($query, $code)
    {
        return $query->where('code', $code);
    }

    /**
     * Scope para erros recentes
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Helper para criar um novo log
     */
    public static function recordError(\Throwable $exception): self
    {
        return self::create([
            'message' => $exception->getMessage(),
            'exception' => get_class($exception),
            'code' => $exception->getCode(),
            'trace' => $exception->getTraceAsString(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'user_id' => Auth::id(),
            'request_uri' => request()->getRequestUri(),
            'request_method' => request()->method(),
            'user_agent' => request()->userAgent(),
            'ip_address' => request()->ip(),
        ]);
    }
}
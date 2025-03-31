<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $table = 'gateways';

    protected $fillable = [
        'name',
        'client_id',
        'secret_key',
        'enable_credit_card',
        'enable_pix',
        'enable_boleto',
        'enable_custom_interest_rate',
        'additional_interest_rate',
        'interest_rule',
        'status',
        'store_id',
    ];

    protected $casts = [
        'enable_credit_card' => 'boolean',
        'enable_pix' => 'boolean',
        'enable_boleto' => 'boolean',
        'enable_custom_interest_rate' => 'boolean',
        'additional_interest_rate' => 'decimal:2',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutCustomizationSetting extends Model
{
    protected $table = 'checkout_customization_settings';

    protected $fillable = ['store_id', 'settings'];

    protected $casts = [
        'settings' => 'array', // Converte o JSON automaticamente para um array PHP
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

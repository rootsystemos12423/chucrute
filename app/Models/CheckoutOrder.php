<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutOrder extends Model
{
    protected $table = 'checkout_orders';

    protected $fillable = [
        'store_id',
        'checkout_token',
        'status',
        'total_value',
        'installments',
        'customer_data',
        'items',
        'shipping_data',
        'payment_data',
        'external_reference',
        'payment_method',
    ];

    protected $casts = [
        'customer_data' => 'array',
        'items' => 'array',
        'shipping_data' => 'array',
        'payment_data' => 'array',
    ];

    /**
     * Relacionamento com a loja (Store).
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    /**
     * Relacionamento com Checkout usando checkout_token corretamente.
     */
    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_token', 'token');
    }
}

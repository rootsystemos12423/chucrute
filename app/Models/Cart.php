<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'token';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'token', 'shop', 'note', 'attributes', 'original_total_price', 
        'total_price', 'total_discount', 'total_weight', 'item_count', 
        'requires_shipping', 'currency', 'items_subtotal_price', 
        'cart_level_discount_applications'
    ];

    protected $casts = [
        'featured_image' => 'array',
        'attributes' => 'array',
        'cart_level_discount_applications' => 'array',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop', 'shopify_url');
    }

    public function checkout()
    {
        return $this->hasMany(Checkout::class, 'cart_token', 'token');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_token', 'token');
    }
}


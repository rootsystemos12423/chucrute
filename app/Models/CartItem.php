<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_token', 'variant_id', 'quantity', 'title', 'price', 
        'original_price', 'discounted_price', 'line_price', 'sku', 'grams', 
        'vendor', 'taxable', 'product_id', 'url', 'image', 'handle', 
        'featured_image', 'options_with_values', 'discounts', 'is_bump', 'bump_id'
    ];

    protected $casts = [
        'featured_image' => 'array',
        'options_with_values' => 'array',
        'discounts' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_token', 'token');
    }
}


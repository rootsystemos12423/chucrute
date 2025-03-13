<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $primaryKey = 'shopify_url';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['shopify_url', 'origin'];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'shop_domain', 'shopify_url');
    }
}

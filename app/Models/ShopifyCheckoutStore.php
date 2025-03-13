<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopifyCheckoutStore extends Model
{
    protected $table = 'shopify_checkout_store';

    protected $fillable = [
        'store_id',
        'shopify_url',
        'shopify_api_token',
        'shopify_api_key',
        'shopify_api_secret',
        'skip_cart',
    ];

     // Relacionamento com a loja do usuário
     public function store()
     {
         return $this->belongsTo(UsersCheckoutStore::class, 'store_id');
     }
}

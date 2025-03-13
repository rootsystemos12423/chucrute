<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBump extends Model
{
    // Defina a tabela se o nome não seguir a convenção do plural
    protected $table = 'order_bumps'; 

    // Defina os campos preenchíveis para permitir a inserção em massa
    protected $fillable = [
        'store_id',
        'product_id',
        'price',
        'discount',
        'status',
        'title',
        'description',
        'button_text',
        'payment_method',
    ];

    // Relacionamento com a tabela users_checkout_stores
    public function store()
    {
        return $this->belongsTo(UserCheckoutStore::class, 'store_id');
    }

    // Relacionamento com a tabela store_products_shopify_checkout
    public function product()
    {
        return $this->belongsTo(StoreProductShopifyCheckout::class, 'product_id', 'product_id');
    }
}

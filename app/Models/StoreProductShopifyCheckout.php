<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreProductShopifyCheckout extends Model
{
    protected $table = 'store_products_shopify_checkout';

    // Definindo os campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'title',
        'body_html',
        'vendor',
        'product_type',
        'created_at_shopify',
        'updated_at_shopify',
        'handle',
        'published_at',
        'template_suffix',
        'published_scope',
        'tags',
        'status',
        'admin_graphql_api_id',
        'variants',
        'options',
        'images',
        'image',
        'user_checkout_store_id',
        'product_id',
    ];

    // Definindo a chave primária, caso não seja a convenção 'id'
    protected $primaryKey = 'id';

    // Definindo o tipo de chave primária, caso não seja o tipo padrão 'int'
    protected $keyType = 'int';

    // Caso você não queira usar as timestamps padrões 'created_at' e 'updated_at'
    public $timestamps = true;

     // Definindo os casts para conversão automática dos campos JSON em arrays
     protected $casts = [
        'variants' => 'array',
        'options' => 'array',
        'images' => 'array',
        'image' => 'array',
    ];

    // Relacionamento com a tabela 'users_checkout_stores'
    public function userCheckoutStore()
    {
        return $this->belongsTo(UsersCheckoutStore::class, 'user_checkout_store_id');
    }
}

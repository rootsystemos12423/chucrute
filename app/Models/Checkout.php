<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    // Define a tabela, caso não siga a convenção plural 'checkouts'
    protected $table = 'checkouts';

    // Atributos que podem ser atribuídos em massa
    protected $fillable = [
        'token',
        'cart_token',
        'shop_domain',
        'customer_email',
        'customer_name',
        'customer_taxId',
        'customer_telphone',
        'customer_shipping_address',
        'subtotal_price',
        'total_price',
        'total_discount',
        'currency',
        'payment_details',
        'steps',
        'store_id',
        'frete_id'
    ];

    // Converte colunas JSON para array automaticamente
    protected $casts = [
        'customer_shipping_address' => 'array',
        'payment_details' => 'array',
    ];

    /**
     * Relacionamento com o carrinho.
     * O checkout pertence a um carrinho identificado por "cart_token".
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_token', 'token');
    }

    /**
     * Relacionamento com a loja.
     * O checkout pertence a uma loja identificada por "shop_domain".
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_domain', 'shopify_url');
    }

    public function store()
    {
        return $this->belongsTo(Store::class); // Um checkout pertence a uma loja
    }

    public function frete()
    {
        return $this->belongsTo(Shipping::class); // Assumindo que você tenha um modelo Frete
    }
}

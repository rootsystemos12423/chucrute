<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersCheckoutStore extends Model
{
    protected $table = 'users_checkout_stores';

    protected $fillable = ['user_id', 'name', 'currency', 'settings'];

    // Relacionamento com ShopifyCheckoutStore (Uma store pode ter várias integrações Shopify)
    public function shopifyStores()
    {
        return $this->hasMany(ShopifyCheckoutStore::class, 'store_id');
    }
}

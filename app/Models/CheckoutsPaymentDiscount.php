<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutsPaymentDiscount extends Model
{
    protected $table = 'checkouts_payment_discount'; 
    protected $fillable = [
        'store_id',
        'payment_method',
        'discount_percentage',
    ];

    // Relacionamento com Store
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

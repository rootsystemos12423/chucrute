<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{

    protected $table = 'shippings';

    protected $fillable = [
        'name',
        'price',
        'min_delivery_days',
        'max_delivery_days',
        'status',
        'store_id'
    ];
}

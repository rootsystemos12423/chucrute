<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleAdsPixel extends Model
{
    protected $table = 'google_ads_pixels'; // Nome da tabela

    protected $fillable = [
        'store_id',
        'conversion_id',
        'conversion_label',
        'name',
        'status',
        'send_event_pix',
        'send_event_bankslip',
    ];

    /**
     * Relacionamento com a loja (users_checkout_stores)
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    /**
     * Definir valores padrão para atributos booleanos
     */
    protected $attributes = [
        'status' => true,
        'send_event_pix' => false,
        'send_event_bankslip' => false,
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains'; 

    protected $fillable = ['store_id', 'domain'];

    /**
     * Relacionamento com a loja (Store).
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

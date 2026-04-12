<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Batch extends Model
{
    protected $fillable = [
        'numero_batch',
        'folder',
        'categoria',
        'descripcion',
        'caja_id'
    ];

    // Relación: Un batch pertenece a una caja
    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class);
    }
}
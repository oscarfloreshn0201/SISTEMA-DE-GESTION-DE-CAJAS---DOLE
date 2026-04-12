<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caja extends Model
{
    protected $fillable = [
        'numero_caja',
        'mes',
        'año',
        'descripcion'
    ];

    // Relación: Una caja tiene muchos batches
    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }

    // Helper para obtener el nombre del mes
    public function getNombreMesAttribute(): string
    {
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
        
        return $meses[$this->mes] ?? 'Mes no válido';
    }

    // Helper para mostrar caja completa (ej: "Caja #001 - Enero 2025")
    public function getDisplayNameAttribute(): string
    {
        return "Caja #{$this->numero_caja} - {$this->nombre_mes} {$this->año}";
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'fecha_registro',
        'cant_meses',
        'tipo',
        'monto_unitario',
        'monto_total',
        'estado',
        'cliente_id',
        'personal_id',
        'precio_id',
        'tipo_membresia',
        'membresia_id',
    ];
}

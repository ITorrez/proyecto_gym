<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;
    protected $fillable = [
        'monto',
        'fecha_registro',
        'descripcion',
        'cantidad_meses',
        'estado',
        'usuario_id',
        'es_promosion',
    ];
}

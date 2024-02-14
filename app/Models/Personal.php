<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'apellido',
        'tipo',
        'telefono',
        'password',
        'estado',
        'user_id',
        'user_reg',
    ];
}

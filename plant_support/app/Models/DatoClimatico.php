<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoClimatico extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'fecha',
        'temperatura',
        'humedad',
        'precipitacion',
        'velocidad_viento',
    ];
}
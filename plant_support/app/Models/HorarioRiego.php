<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioRiego extends Model
{
    use HasFactory;

    protected $fillable = [
        'zona_riego_id',
        'dia_semana',
        'hora_inicio',
        'duracion_minutos',
    ];

    public function zonaRiego()
    {
        return $this->belongsTo(ZonaRiego::class);
    }
}
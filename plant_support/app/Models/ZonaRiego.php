<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaRiego extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre_zona',
        'ubicacion',
        'tipo_cultivo',
        'area_metros', // <-- AÑADIR
        'estado',      // <-- AÑADIR
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarios()
    {
        return $this->hasMany(HorarioRiego::class);
    }

    public function registros()
    {
        return $this->hasMany(RegistroRiego::class);
    }
}

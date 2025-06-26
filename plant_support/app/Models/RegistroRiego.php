<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroRiego extends Model
{
    use HasFactory;

    // Añadimos 'user_id' a los campos que se pueden llenar masivamente
    protected $fillable = [
        'zona_riego_id',
        'user_id', // <-- AÑADIR
        'fecha_hora',
        'cantidad_agua',
    ];
    
    // Añadimos la relación para saber qué usuario hizo el registro
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zonaRiego()
    {
        return $this->belongsTo(ZonaRiego::class);
    }
}
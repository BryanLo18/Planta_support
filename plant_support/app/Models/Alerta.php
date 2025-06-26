<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo_alerta',
        'mensaje',
        'leida',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
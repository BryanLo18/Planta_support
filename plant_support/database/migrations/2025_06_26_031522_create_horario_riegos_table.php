<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horario_riegos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zona_riego_id')->constrained('zona_riegos')->onDelete('cascade');
            $table->string('dia_semana'); // Ej: 'Lunes', 'Martes', etc.
            $table->time('hora_inicio');
            $table->integer('duracion_minutos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horario_riegos');
    }
};
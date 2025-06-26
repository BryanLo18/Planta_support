<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datos_climaticos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('temperatura', 5, 2);
            $table->decimal('humedad', 5, 2);
            $table->decimal('precipitacion', 8, 2);
            $table->decimal('velocidad_viento', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datos_climaticos');
    }
};
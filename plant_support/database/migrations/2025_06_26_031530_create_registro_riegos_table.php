<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_riegos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zona_riego_id')->constrained('zona_riegos')->onDelete('cascade');
            $table->dateTime('fecha_hora');
            $table->decimal('cantidad_agua', 8, 2); // Litros
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_riegos');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zona_riegos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nombre_zona');
            $table->string('ubicacion')->nullable();
            $table->string('tipo_cultivo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zona_riegos');
    }
};
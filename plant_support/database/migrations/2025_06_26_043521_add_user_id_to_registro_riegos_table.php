<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registro_riegos', function (Blueprint $table) {
            // Añadimos la columna user_id después de zona_riego_id
            // Puede ser nulo por si hay registros antiguos sin usuario.
            $table->foreignId('user_id')->after('zona_riego_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('registro_riegos', function (Blueprint $table) {
            // Para deshacer, quitamos la clave foránea y luego la columna.
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
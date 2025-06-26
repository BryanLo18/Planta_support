    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('zona_riegos', function (Blueprint $table) {
                // Añadimos el área en metros cuadrados, después del tipo de cultivo.
                $table->decimal('area_metros', 8, 2)->after('tipo_cultivo')->nullable();

                // Añadimos el estado, con "Activo" como valor por defecto.
                $table->string('estado')->after('area_metros')->default('Activo');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('zona_riegos', function (Blueprint $table) {
                $table->dropColumn('area_metros');
                $table->dropColumn('estado');
            });
        }
    };
    
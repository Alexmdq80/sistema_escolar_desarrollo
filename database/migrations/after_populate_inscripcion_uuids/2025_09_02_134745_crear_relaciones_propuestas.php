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
        Schema::table('propuestas', function (Blueprint $table) {

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('plan_anio_id')
                  ->references('id')
                  ->on('plan_anios')
                  ->onDelete('restrict');

            $table->foreign('turno_inicio_id')
                  ->references('id')
                  ->on('turnos')
                  ->onDelete('restrict');

            $table->foreign('turno_fin_id')
                  ->references('id')
                  ->on('turnos')
                  ->onDelete('restrict');

            $table->foreign('jornada_id')
                  ->references('id')
                  ->on('jornadas')
                  ->onDelete('restrict');

            $table->foreign('lectivo_id')
                  ->references('id')
                  ->on('lectivos')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propuestas', function (Blueprint $table) {

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['plan_anio_id']);
            $table->dropForeign(['turno_inicio_id']);
            $table->dropForeign(['turno_fin_id']);
            $table->dropForeign(['jornada_id']);
            $table->dropForeign(['lectivo_id']);

            $table->dropIndex('propuestas_escuela_id_foreign');
            $table->dropIndex('propuestas_plan_anio_id_foreign');
            $table->dropIndex('propuestas_turno_inicio_id_foreign');
            $table->dropIndex('propuestas_turno_fin_id_foreign');
            $table->dropIndex('propuestas_jornada_id_foreign');
            $table->dropIndex('propuestas_lectivo_id_foreign');

        });

    }
};

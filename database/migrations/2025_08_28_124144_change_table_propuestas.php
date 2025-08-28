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
            $table->softDeletes();

            $table->dropColumn('id_plan_estudio');
            $table->dropColumn('id_ciclo_plan_estudio');
            $table->dropColumn('id_anio');

            $table->renameColumn('id_anio_plan', 'plan_anio_id');
            $table->renameColumn('id_turno_inicio', 'turno_inicio_id');
            $table->renameColumn('id_turno_fin', 'turno_fin_id');
            $table->renameColumn('id_jornada', 'jornada_id');
            $table->renameColumn('id_ciclo_lectivo', 'lectivo_id');

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
            $table->dropSoftDeletes();

            $table->dropForeign(['plan_anio_id']);
            $table->dropForeign(['turno_inicio_id']);
            $table->dropForeign(['turno_fin_id']);
            $table->dropForeign(['jornada_id']);
            $table->dropForeign(['lectivo_id']);

            $table->dropIndex('propuestas_plan_anio_id_foreign');
            $table->dropIndex('propuestas_turno_inicio_id_foreign');
            $table->dropIndex('propuestas_turno_fin_id_foreign');
            $table->dropIndex('propuestas_jornada_id_foreign');
            $table->dropIndex('propuestas_lectivo_id_foreign');

            $table->renameColumn('plan_anio_id', 'id_anio_plan');
            $table->renameColumn('turno_inicio_id', 'id_turno_inicio');
            $table->renameColumn('turno_fin_id', 'id_turno_fin');
            $table->renameColumn('jornada_id', 'id_jornada');
            $table->renameColumn('lectivo_id', 'id_ciclo_lectivo');

            // luego habría que correr algún seeder en caso de querer restaurar por completo la BD
            $table->smallInteger('id_plan_estudio')->after('id')->unsigned();
            $table->tinyInteger('id_ciclo_plan_estudio')->after('id')->unsigned();
            $table->tinyInteger('id_anio')->after('id')->unsigned();


        });
    }
};

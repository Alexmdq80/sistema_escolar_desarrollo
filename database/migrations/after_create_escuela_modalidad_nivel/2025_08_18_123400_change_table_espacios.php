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
        Schema::table('espacios', function (Blueprint $table) {
            $table->softDeletes();

            // * ojo que se borran los datos!!!
            $table->dropColumn('id_plan_estudio');
            $table->dropColumn('id_ciclo_plan_estudio');
            $table->dropColumn('id_anio');
            $table->dropColumn('id_anio_plan');
            $table->dropColumn('id_turno_inicio');
            $table->dropColumn('id_turno_fin');
            $table->dropColumn('id_ciclo_lectivo');

            $table->renameColumn('id_propuesta_institucional', 'propuesta_id');
            $table->renameColumn('id_seccion_tipo','seccion_tipo_id');
            



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espacios', function (Blueprint $table) {
            $table->dropSoftDeletes();



            $table->smallInteger('id_plan_estudio')->unsigned()->after('id');
            $table->tinyInteger('id_ciclo_plan_estudio')->unsigned()->after('id');
            $table->tinyInteger('id_anio')->unsigned()->after('id');
            $table->mediumInteger('id_anio_plan')->unsigned()->after('id');
            $table->tinyInteger('id_turno_inicio')->unsigned()->after('id');
            $table->tinyInteger('id_turno_fin')->unsigned()->after('id');
            $table->tinyInteger('id_ciclo_lectivo')->unsigned()->after('id');

            $table->renameColumn('propuesta_id', 'id_propuesta_institucional');
            $table->renameColumn('seccion_tipo_id', 'id_seccion_tipo');

        });
    }
};

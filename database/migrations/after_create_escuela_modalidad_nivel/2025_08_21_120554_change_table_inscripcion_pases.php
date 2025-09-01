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
        Schema::table('inscripcion_pases', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE inscripcion_pases MODIFY id INT');
            $table->dropPrimary('id');    
        });
        Schema::table('inscripcion_pases', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            // REUBICAR COLUMNAS / MODIFICAR
            $table->bigIncrements('id')->change();

            $table->dropColumn('id_region_educativa');
            $table->dropColumn('id_departamento_escuela');
            $table->dropColumn('id_provincia_escuela');
            $table->dropColumn('id_pais_escuela');
            $table->dropColumn('id_tipo_escuela');
            $table->dropColumn('id_sector');

            $table->renameColumn('id_escuela', 'escuela_id');
            $table->renameColumn('id_inscripcion_historial', 'historial_inscripcion_id');
            $table->renameColumn('id_salida_motivo', 'salida_motivo_id');
            $table->renameColumn('id_ubicacion_escuela', 'escuela_ubicacion_id');

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('historial_inscripcion_id')
                  ->references('id')
                  ->on('historial_inscripcions')
                  ->onDelete('restrict');

            $table->foreign('salida_motivo_id')
                  ->references('id')
                  ->on('salida_motivos')
                  ->onDelete('restrict');

            $table->foreign('escuela_ubicacion_id')
                  ->references('id')
                  ->on('escuela_ubicacions')
                  ->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_pases', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE inscripcion_pases MODIFY id BIGINT');
            $table->dropPrimary('id');
        });
        Schema::table('inscripcion_pases', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['salida_motivo_id']);
            $table->dropForeign(['escuela_ubicacion_id']);

            $table->dropIndex('inscripcion_pases_escuela_id_foreign');
            $table->dropIndex('inscripcion_pases_historial_inscripcion_id_foreign');
            $table->dropIndex('inscripcion_pases_salida_motivo_id_foreign');
            $table->dropIndex('inscripcion_pases_escuela_ubicacion_id_foreign');

            $table->renameColumn('escuela_id', 'id_escuela');
            $table->renameColumn('historial_inscripcion_id', 'id_inscripcion_historial');
            $table->renameColumn('salida_motivo_id', 'id_salida_motivo');
            $table->renameColumn('escuela_ubicacion_id', 'id_ubicacion_escuela');

            $table->tinyInteger('id_region_educativa')->unsigned()->nullable()->after('id');
            $table->smallInteger('id_departamento_escuela')->unsigned()->nullable()->after('id');
            $table->tinyInteger('id_provincia_escuela')->unsigned()->nullable()->after('id');
            $table->tinyInteger('id_pais_escuela')->unsigned()->nullable()->after('id');
            $table->unsignedTinyInteger('id_tipo_escuela')->nullable()->after('id');
            $table->tinyInteger('id_sector')->unsigned()->nullable()->after('id');
        });

        Schema::table('inscripcion_pases', function (Blueprint $table) {
        // REUBICAR COLUMNAS / MODIFICAR
            $table->increments('id')->change();
        });
    }
};

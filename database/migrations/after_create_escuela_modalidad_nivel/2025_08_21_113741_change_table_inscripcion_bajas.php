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
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE inscripcion_bajas MODIFY id INT');
            $table->dropPrimary('id');
        });
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
// REUBICAR COLUMNAS / MODIFICAR
            $table->bigIncrements('id')->change();

            $table->renameColumn('id_inscripcion_historial', 'historial_inscripcion_id');
            $table->renameColumn('id_salida_motivo', 'salida_motivo_id');

            $table->foreign('historial_inscripcion_id')
                  ->references('id')
                  ->on('historial_inscripcions')
                  ->onDelete('restrict');

            $table->foreign('salida_motivo_id')
                  ->references('id')
                  ->on('salida_motivos')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            // Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
            // Esto se debe hacer con una sentencia SQL cruda en este caso
            DB::statement('ALTER TABLE inscripcion_bajas MODIFY id BIGINT');
            $table->dropPrimary('id');
        });
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['salida_motivo_id']);

            $table->dropIndex('inscripcion_bajas_historial_inscripcion_id_foreign');
            $table->dropIndex('inscripcion_bajas_salida_motivo_id_foreign');

            $table->renameColumn('historial_inscripcion_id', 'id_inscripcion_historial');
            $table->renameColumn('salida_motivo_id', 'id_salida_motivo');
        });
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->increments('id')->change();
        });
    }
};

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
        Schema::table('inscripcion_finalizados', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
// REUBICAR COLUMNAS / MODIFICAR
            $table->unsignedBigInteger('id')->change();

            $table->renameColumn('id_inscripcion_historial', 'historial_inscripcion_id');
            $table->renameColumn('id_condicion', 'condicion_id');

            $table->foreign('historial_inscripcion_id')
                  ->references('id')
                  ->on('historial_inscripcions')
                  ->onDelete('restrict');

            $table->foreign('condicion_id')
                  ->references('id')
                  ->on('condicions')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_finalizados', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['condicion_id']);

            $table->dropIndex('inscripcion_finalizados_historial_inscripcion_id_foreign');
            $table->dropIndex('inscripcion_finalizados_condicion_id_foreign');

            $table->renameColumn('historial_inscripcion_id', 'id_inscripcion_historial');
            $table->renameColumn('condicion_id', 'id_condicion');
        });

    Schema::table('inscripcion_finalizados', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->integer('id')->unsigned()->change();
        });
    }
};

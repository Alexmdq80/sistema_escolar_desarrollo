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
        Schema::table('historial_info_inscripcions', function (Blueprint $table) {
            $table->softDeletes();

            $table->dropColumn('id_usuario');
           
            $table->tinyInteger('id_inscripcion_cierre')->unsigned()->after('id_inscripcion_historial')->change();

            $table->renameColumn('id_inscripcion_historial', 'historial_inscripcion_id');
            $table->renameColumn('id_inscripcion_cierre', 'cierre_causa_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_info_inscripcions', function (Blueprint $table) {
            $table->dropSoftDeletes();


            $table->unsignedBigInteger('id_usuario')->comment('Usuario que realizó el movimiento');
          
            $table->renameColumn('historial_inscripcion_id', 'id_inscripcion_historial');
            $table->renameColumn('cierre_causa_id', 'id_inscripcion_cierre');

        });
    }
};

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
        Schema::table('inscripcion_baja', function (Blueprint $table) {
            //
            $table->renameColumn('id_pase_motivo','id_salida_motivo');
            $table->renameIndex('inscripcion_baja_id_pase_motivo_foreign', 'inscripcion_baja_id_salida_motivo_foreign');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_baja', function (Blueprint $table) {
            //
            $table->renameColumn('id_salida_motivo','id_pase_motivo');
            $table->renameIndex('inscripcion_baja_id_salida_motivo_foreign', 'inscripcion_baja_id_pase_motivo_foreign');

        });
    }
};

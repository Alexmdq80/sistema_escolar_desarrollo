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
        // renombrar tablas relacionadas a inscripciones
        Schema::rename('inscripcion', 'inscripcions');
        Schema::rename('inscripcion_historial', 'historial_inscripcions');
        Schema::rename('inscripcion_historial_info', 'historial_info_inscripcions');
        Schema::rename('inscripcion_finalizado', 'inscripcion_finalizados');
        Schema::rename('inscripcion_baja', 'inscripcion_bajas');
        Schema::rename('inscripcion_pase', 'inscripcion_pases');
        Schema::rename('inscripcion_cierre', 'cierre_causas');
        Schema::rename('salida_motivo', 'salida_motivos');
        Schema::rename('ubicacion_escuela', 'ubicacion_escuelas');
        Schema::rename('tipo_escuela', 'tipo_escuelas');
        Schema::rename('condicion', 'condicions');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('inscripcions', 'inscripcion');
        Schema::rename('historial_inscripcions', 'inscripcion_historial');
        Schema::rename('historial_info_inscripcions', 'inscripcion_historial_info');
        Schema::rename('inscripcion_finalizados', 'inscripcion_finalizado');
        Schema::rename('inscripcion_bajas', 'inscripcion_baja');
        Schema::rename('inscripcion_pases', 'inscripcion_pase');
        Schema::rename('cierre_causas', 'inscripcion_cierre');
        Schema::rename('salida_motivos', 'salida_motivo');
        Schema::rename('ubicacion_escuelas', 'ubicacion_escuela');
        Schema::rename('tipo_escuelas', 'tipo_escuela');
        Schema::rename('condicions', 'condicion');

    }
};

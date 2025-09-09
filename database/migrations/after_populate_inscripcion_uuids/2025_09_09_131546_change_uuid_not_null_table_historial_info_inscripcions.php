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
        // HAY UN PROBLEMA CON LA PERSONA 1175 (CENTURION, SANTIAGO) (CORREGIDO EN BD DIRECTAMENTE)
        // Y LUEGO CON ALGUNOS CONDICIÓN 5 CICLO LECTIVO 2 QUE POR
        // ALGUNA RAZÓN NO SE GENERA EL UUID
        // 'Genera un UUID para los registros de HistorialInscripcion con cierre_causa_id = 1.';
        Artisan::call('generar:historial-uuid');   
        // 'Actualiza el UUID de HistorialInscripcion basado en condiciones específicas.';
        // primero, los que tienen cierre_causa_id = 5 y lectivo_id = 2
        Artisan::call('actualizar:historial-inscripcion-uuids');
        // 'Genera un UUID para los registros de HistorialInscripcion con cierre_causa_id = 3.';
        Artisan::call('generar:historial-uuid-cierre-baja');
        // 'Actualiza el UUID de HistorialInscripcion basado en la causa de cierre 3, copiando de la causa 1 previa o generando uno nuevo.';
        Artisan::call('actualizar:historial-uuid-cierre-pase');
        
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            $table->uuid('inscripcion_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            $table->uuid('inscripcion_id')->nullable()->change();
        });
    }
};

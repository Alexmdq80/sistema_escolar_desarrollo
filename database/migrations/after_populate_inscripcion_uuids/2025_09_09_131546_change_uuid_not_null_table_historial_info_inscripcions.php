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
        // ESTE PROCESO GENERA UN UUID PARA LA TABLA HISTORIAL_INSCRIPCIONS, EN LA
        // COLUMNA INSCRIPCION_ID.
        // PERO, TIENE QUE GENERAR TENIENDO EN CUENTA SI ESE REGISTRO TIENE UN
        // REGISTRO ORIGINAL EN LA TABLA INSCRIPCIONS, 
        // O SI TIENE UN REGISTRO PREVIO (ORIGINAL) EN LA MISMA TABLA
        // LUEGO, REPLICA TODOS LOS REGISTROS QUE FUERON FINALIZADOS, O DADOS DE BAJA
        // LOS MARCA COMO SOFTDELETES, Y LOS DEVUELVE A INSCRIPCIONS.
        // AL FINAL, EN LA MIGRACIÓN PRÓXIMA LE CREO LA CLAVE FORÁNEA QUE APUNTE A 
        // INSCRIPCIONS, PARA ASÍ RELACIONAR LOS MODELOS.
        // 'Genera un UUID para los registros de HistorialInscripcion con cierre_causa_id = 1.';
        Artisan::call('generar:historial-uuid');   
        // 'Actualiza el UUID de HistorialInscripcion basado en condiciones específicas.';
        // primero, los que tienen cierre_causa_id = 5 y lectivo_id = 2
        Artisan::call('actualizar:historial-inscripcion-uuids');
        // 'Genera un UUID para los registros de HistorialInscripcion con cierre_causa_id = 3.';
        Artisan::call('generar:historial-uuid-cierre-baja');
        // 'Actualiza el UUID de HistorialInscripcion basado en la causa de cierre 3, copiando de la causa 1 previa o generando uno nuevo.';
        Artisan::call('actualizar:historial-uuid-cierre-pase');
        //  Recuperar las inscripciones finalizadas y marcarlas con softDeletes      
        Artisan::call('inscripciones:replicar-finalizadas');
        //  Recuperar las inscripciones bajadas y marcarlas con softDeletes      
        Artisan::call('inscripciones:replicar-bajadas');
        
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

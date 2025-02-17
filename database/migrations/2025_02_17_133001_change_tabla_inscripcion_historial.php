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
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            // LE QUITO EL NULLABLE A id_usuario
            // Y ELIMINO LAS CLAVES DE RESPONSABLES Y RESTRINGIDAS
            // PORQUE VOY A USAR DE CLAVE id_persona y el id_de vínculo
            $table->unsignedBigInteger('id_usuario')->change();
            $table->dropForeign('inscripcion_historial_responsable_1_foreign');
            $table->dropColumn('responsable_1');
            $table->dropForeign('inscripcion_historial_responsable_2_foreign');
            $table->dropColumn('responsable_2');
            $table->dropForeign('inscripcion_historial_restringida_foreign');
            $table->dropColumn('restringida');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->unsignedBigInteger('responsable_1')->nullable()->comment('ID de EAV. Primer adulto responsable que figura en la inscripción.');
            $table->foreign('responsable_1')->references('id')->on('estudiante_adulto_vinculo');
            $table->unsignedBigInteger('responsable_2')->nullable()->comment('ID de EAV. Segundo adulto responsable que figura en la inscripción.');
            $table->foreign('responsable_2')->references('id')->on('estudiante_adulto_vinculo');
            $table->unsignedBigInteger('restringida')->nullable()->comment('ID de EAV. Adulto con restricción hacia el estudiante.');
            $table->foreign('restringida')->references('id')->on('estudiante_adulto_vinculo');
        });
    }
};

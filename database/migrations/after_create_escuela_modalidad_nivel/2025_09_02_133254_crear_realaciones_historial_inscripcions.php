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
        Schema::table('historial_inscripcions', function (Blueprint $table) {

            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');

            $table->foreign('persona_firma_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');

            $table->foreign('espacio_id')
                  ->references('id')
                  ->on('espacios')
                  ->onDelete('restrict');

            $table->foreign('condicion_id')
                  ->references('id')
                  ->on('condicions')
                  ->onDelete('restrict');

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('modalidad_id')
                  ->references('id')
                  ->on('modalidads')
                  ->onDelete('restrict');

            $table->foreign('nivel_id')
                  ->references('id')
                  ->on('nivels')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_inscripcions', function (Blueprint $table) {

            $table->dropForeign(['persona_id']);
            $table->dropForeign(['persona_firma_id']);
            $table->dropForeign(['espacio_id']);
            $table->dropForeign(['condicion_id']);
            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['modalidad_id']);
            $table->dropForeign(['nivel_id']);
            $table->dropForeign(['persona_vinculo_persona_1_id']);
            $table->dropForeign(['persona_vinculo_persona_2_id']);
            $table->dropForeign(['persona_vinculo_persona_3_id']);

            $table->dropIndex('historial_inscripcions_persona_id_foreign');
            $table->dropIndex('historial_inscripcions_persona_firma_id_foreign');
            $table->dropIndex('historial_inscripcions_espacio_id_foreign');
            $table->dropIndex('historial_inscripcions_condicion_id_foreign');
            $table->dropIndex('historial_inscripcions_escuela_id_foreign');
            $table->dropIndex('historial_inscripcions_modalidad_id_foreign');
            $table->dropIndex('historial_inscripcions_nivel_id_foreign');
            $table->dropIndex('historial_inscripcions_persona_vinculo_persona_1_id_foreign');
            $table->dropIndex('historial_inscripcions_persona_vinculo_persona_2_id_foreign');
            $table->dropIndex('historial_inscripcions_persona_vinculo_persona_3_id_foreign');
        });
    }
};

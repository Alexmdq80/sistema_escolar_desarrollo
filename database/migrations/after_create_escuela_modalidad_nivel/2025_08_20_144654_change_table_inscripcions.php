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
        Schema::table('inscripcions', function (Blueprint $table) {
            $table->softDeletes();
            // QUITAR COLUMNAS INNECESARIAS
            $table->dropColumn('id_usuario');
            $table->dropColumn('id_escuela_destino');
            $table->dropColumn('id_ciclo_lectivo');
// REUBICAR COLUMNAS / MODIFICAR
            $table->unsignedBigInteger('id')->change();
            $table->unsignedBigInteger('id_persona')->change();
            $table->unsignedBigInteger('id_persona_firma')->nullable()->change();
            $table->unsignedBigInteger('restringida')->nullable()->after('id_condicion')->change();
            $table->unsignedBigInteger('responsable_2')->nullable()->after('id_condicion')->change();
            $table->unsignedBigInteger('responsable_1')->nullable()->after('id_condicion')->change();

// RENOMBRAR COLUMNAS
            $table->renameColumn('id_persona', 'persona_id');
            $table->renameColumn('id_persona_firma', 'persona_firma_id');

            $table->renameColumn('id_espacio_academico', 'espacio_id');
            $table->renameColumn('id_nivel_procedencia', 'nivel_id');
            $table->renameColumn('id_modalidad_procedencia', 'modalidad_id');
            $table->renameColumn('id_escuela_procedencia', 'escuela_id');
            $table->renameColumn('id_condicion', 'condicion_id');

            $table->renameColumn('responsable_1', 'persona_vinculo_persona_1_id');
            $table->renameColumn('responsable_2', 'persona_vinculo_persona_2_id');
            $table->renameColumn('restringida', 'persona_vinculo_persona_3_id');

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

            $table->foreign('persona_vinculo_persona_1_id')
                  ->references('id')
                  ->on('persona_vinculo_persona')
                  ->onDelete('restrict');

            $table->foreign('persona_vinculo_persona_2_id')
                  ->references('id')
                  ->on('persona_vinculo_persona')
                  ->onDelete('restrict');

            $table->foreign('persona_vinculo_persona_3_id')
                  ->references('id')
                  ->on('persona_vinculo_persona')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcions', function (Blueprint $table) {
            $table->dropSoftDeletes();

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

            $table->dropIndex('inscripcions_persona_id_foreign');
            $table->dropIndex('inscripcions_persona_firma_id_foreign');
            $table->dropIndex('inscripcions_espacio_id_foreign');
            $table->dropIndex('inscripcions_condicion_id_foreign');
            $table->dropIndex('inscripcions_escuela_id_foreign');
            $table->dropIndex('inscripcions_modalidad_id_foreign');
            $table->dropIndex('inscripcions_nivel_id_foreign');
            $table->dropIndex('inscripcions_persona_vinculo_persona_1_id_foreign');
            $table->dropIndex('inscripcions_persona_vinculo_persona_2_id_foreign');
            $table->dropIndex('inscripcions_persona_vinculo_persona_3_id_foreign');

            $table->unsignedBigInteger('id_usuario')->comment('Usuario que realizó el movimiento')->after('id');
            $table->unsignedMediumInteger('id_escuela_destino');
            $table->unsignedTinyInteger('id_ciclo_lectivo');
        });

        Schema::table('inscripcions', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->smallInteger('id')->unsigned()->change();
            $table->integer('persona_id')->unsigned()->change();
            $table->integer('persona_firma_id')->unsigned()->nullable()->change();

            $table->renameColumn('persona_id', 'id_persona');
            $table->renameColumn('persona_firma_id', 'id_persona_firma');

            $table->renameColumn('persona_vinculo_persona_1_id', 'responsable_1');
            $table->renameColumn('persona_vinculo_persona_2_id', 'responsable_2');
            $table->renameColumn('persona_vinculo_persona_3_id', 'restringida');

            $table->renameColumn('espacio_id', 'id_espacio_academico');
            $table->renameColumn('nivel_id', 'id_nivel_procedencia');
            $table->renameColumn('modalidad_id', 'id_modalidad_procedencia');
            $table->renameColumn('escuela_id', 'id_escuela_procedencia');
            $table->renameColumn('condicion_id', 'id_condicion');
        });
    }
};

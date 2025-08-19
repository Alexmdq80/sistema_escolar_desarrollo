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
            $table->softDeletes();
           
            $table->tinyInteger('id_adulto_vinculo_3')->unsigned()->after('id_persona_firma')->change();
            $table->integer('id_persona_adulto_3')->unsigned()->after('id_persona_firma')->change();
            $table->tinyInteger('id_adulto_vinculo_2')->unsigned()->after('id_persona_firma')->change();
            $table->integer('id_persona_adulto_2')->unsigned()->after('id_persona_firma')->change();
            $table->tinyInteger('id_adulto_vinculo_1')->unsigned()->after('id_persona_firma')->change();
            $table->integer('id_persona_adulto_1')->unsigned()->after('id_persona_firma')->change();

            $table->dropColumn('id_usuario');
            $table->dropColumn('id_escuela_destino');
            $table->dropColumn('id_ciclo_lectivo');

            $table->renameColumn('id_persona', 'persona_id');
            $table->renameColumn('id_persona_firma', 'persona_firma_id');
            $table->renameColumn('id_persona_adulto_1', 'persona_adulto_1_id');
            $table->renameColumn('id_persona_adulto_2', 'persona_adulto_2_id');
            $table->renameColumn('id_persona_adulto_3', 'persona_adulto_3_id');
            $table->renameColumn('id_adulto_vinculo_1', 'vinculo_adulto_1_id');
            $table->renameColumn('id_adulto_vinculo_2', 'vinculo_adulto_2_id');
            $table->renameColumn('id_adulto_vinculo_3', 'vinculo_adulto_3_id');

            $table->renameColumn('id_espacio_academico', 'espacio_academico_id');
            $table->renameColumn('id_nivel_procedencia', 'nivel_id');
            $table->renameColumn('id_modalidad_procedencia', 'modalidad_id');
            $table->renameColumn('id_ecuela_procedencia', 'escuela_id');
            $table->renameColumn('id_condicion', 'condicion_id');

            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->unsignedBigInteger('id_usuario')->comment('Usuario que realizó el movimiento');


        });
    }
};

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
        // SE ELIMNARAN LOS DATOS DE CICLO LECTIVO, USUARIO Y ESCUELA DESTINO
        // DE QUERER HACER UN ROLLBACK DE TODO, HABRÍA QUE HACER LUEGO UN
        // SCRIPT PARA RESTAURAR ESOS DATOS, AUNQUE NO VA A SER NECESARIO
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            // 1. Agrega las nuevas columnas para los IDs de la tabla pivot.
            $table->foreignId('persona_vinculo_persona_3_id')->nullable()->after('id_condicion')->constrained('persona_vinculo_persona')->onDelete('restrict');
            $table->foreignId('persona_vinculo_persona_2_id')->nullable()->after('id_condicion')->constrained('persona_vinculo_persona')->onDelete('restrict');
            $table->foreignId('persona_vinculo_persona_1_id')->nullable()->after('id_condicion')->constrained('persona_vinculo_persona')->onDelete('restrict');
        });

        Schema::table('historial_inscripcions', function (Blueprint $table) {

        // 1. Migra los datos de las columnas viejas a las nuevas.
            DB::table('historial_inscripcions')->orderBy('id')->chunk(1000, function ($inscripciones) {
                foreach ($inscripciones as $inscripcion) {
                    // Lógica de migración para el adulto 1
                    if ($inscripcion->id_persona_adulto_1 && $inscripcion->id_adulto_vinculo_1) {
                        $pivotRecord1 = DB::table('persona_vinculo_persona')
                            ->where('persona_estudiante_id', $inscripcion->id_persona)
                            ->where('persona_adulto_id', $inscripcion->id_persona_adulto_1)
                            ->where('vinculo_id', $inscripcion->id_adulto_vinculo_1)
                            ->first();

                        if ($pivotRecord1) {
                            DB::table('historial_inscripcions')
                                ->where('id', $inscripcion->id)
                                ->update(['persona_vinculo_persona_1_id' => $pivotRecord1->id]);
                        }
                    }

                    // Lógica de migración para el adulto 2 (ejemplo)
                    if ($inscripcion->id_persona_adulto_2 && $inscripcion->id_adulto_vinculo_2) {
                        $pivotRecord2 = DB::table('persona_vinculo_persona')
                            ->where('persona_estudiante_id', $inscripcion->id_persona)
                            ->where('persona_adulto_id', $inscripcion->id_persona_adulto_2)
                            ->where('vinculo_id', $inscripcion->id_adulto_vinculo_2)
                            ->first();

                        if ($pivotRecord2) {
                            DB::table('historial_inscripcions')
                                ->where('id', $inscripcion->id)
                                ->update(['persona_vinculo_persona_2_id' => $pivotRecord2->id]);
                        }
                    }

                    // Lógica de migración para el adulto 3 (ejemplo)
                    if ($inscripcion->id_persona_adulto_3 && $inscripcion->id_adulto_vinculo_3) {
                        $pivotRecord3 = DB::table('persona_vinculo_persona')
                            ->where('persona_estudiante_id', $inscripcion->id_persona)
                            ->where('persona_adulto_id', $inscripcion->id_persona_adulto_2)
                            ->where('vinculo_id', $inscripcion->id_adulto_vinculo_3)
                            ->first();

                        if ($pivotRecord3) {
                            DB::table('historial_inscripcions')
                                ->where('id', $inscripcion->id)
                                ->update(['persona_vinculo_persona_3_id' => $pivotRecord3->id]);
                        }
                    }
                }
            });

            $table->softDeletes();

            // QUITAR COLUMNAS INNECESARIAS
            $table->dropColumn('id_usuario');
            $table->dropColumn('id_escuela_destino');
            $table->dropColumn('id_ciclo_lectivo');
            $table->dropColumn('id_adulto_vinculo_1');
            $table->dropColumn('id_persona_adulto_1');
            $table->dropColumn('id_adulto_vinculo_2');
            $table->dropColumn('id_persona_adulto_2');
            $table->dropColumn('id_adulto_vinculo_3');
            $table->dropColumn('id_persona_adulto_3');

            // REUBICAR COLUMNAS / MODIFICAR
            $table->unsignedBigInteger('id_persona')->change();
            $table->unsignedBigInteger('id_persona_firma')->nullable()->change();

            // AGREGAR UUIDS
            $table->uuid('inscripcion_id')->nullable()->after('id');

            // RENOMBRAR COLUMNAS
            $table->renameColumn('id_persona', 'persona_id');
            $table->renameColumn('id_persona_firma', 'persona_firma_id');

            $table->renameColumn('id_espacio_academico', 'espacio_id');
            $table->renameColumn('id_nivel_procedencia', 'nivel_id');
            $table->renameColumn('id_modalidad_procedencia', 'modalidad_id');
            $table->renameColumn('id_escuela_procedencia', 'escuela_id');
            $table->renameColumn('id_condicion', 'condicion_id');


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            // ACÁ HABRÍA QUE CREAR LAS COLUMNAS
            $table->unsignedInteger('id_persona_adulto_1')->nullable()->comment('ID de persona del primer adulto responsable que figura en la inscripción.');
            $table->tinyInteger('id_adulto_vinculo_1')->unsigned()->nullable();
            $table->unsignedInteger('id_persona_adulto_2')->nullable()->comment('ID de persona del segundo adulto responsable que figura en la inscripción.');
            $table->tinyInteger('id_adulto_vinculo_2')->unsigned()->nullable();
            $table->unsignedInteger('id_persona_adulto_3')->nullable()->comment('ID de persona del restringido que figura en la inscripción.');
            $table->tinyInteger('id_adulto_vinculo_3')->unsigned()->nullable();
        });

        Schema::table('historial_inscripcions', function (Blueprint $table) {
            // Migra los datos de las columnas viejas a las nuevas.
            DB::table('historial_inscripcions')->orderBy('id')->chunk(1000, function ($inscripciones) {
                foreach ($inscripciones as $inscripcion) {
                    // Lógica de migración para el adulto 1
                    if ($inscripcion->persona_vinculo_persona_1_id) {
                        $pivotRecord1 = DB::table('persona_vinculo_persona')
                            ->where('id', $inscripcion->persona_vinculo_persona_1_id)
                            ->first();
                        if ($pivotRecord1) {
                            DB::table('historial_inscripcions')->where('id', $inscripcion->id)->update(['id_persona_adulto_1' => $pivotRecord1->persona_adulto_id,
                                                                                                        'id_adulto_vinculo_1' => $pivotRecord1->vinculo_id]);
                        }
                    }
                    // Lógica de migración para el adulto 2
                    if ($inscripcion->persona_vinculo_persona_2_id) {
                        $pivotRecord1 = DB::table('persona_vinculo_persona')
                            ->where('id', $inscripcion->persona_vinculo_persona_2_id)
                            ->first();
                        if ($pivotRecord1) {
                            DB::table('historial_inscripcions')->where('id', $inscripcion->id)->update(['id_persona_adulto_2' => $pivotRecord1->persona_adulto_id,
                                                                                                        'id_adulto_vinculo_2' => $pivotRecord1->vinculo_id]);
                        }
                    }
                    // Lógica de migración para el adulto 3
                    if ($inscripcion->persona_vinculo_persona_3_id) {
                        $pivotRecord1 = DB::table('persona_vinculo_persona')
                            ->where('id', $inscripcion->persona_vinculo_persona_3_id)
                            ->first();
                        if ($pivotRecord1) {
                            DB::table('historial_inscripcions')->where('id', $inscripcion->id)->update(['id_persona_adulto_3' => $pivotRecord1->persona_adulto_id,
                                                                                                        'id_adulto_vinculo_3' => $pivotRecord1->vinculo_id]);
                        }
                    }

                }
            });

            $table->dropSoftDeletes();


            $table->unsignedBigInteger('id_usuario')->comment('Usuario que realizó el movimiento')->after('id');
            $table->unsignedMediumInteger('id_escuela_destino');
            $table->unsignedTinyInteger('id_ciclo_lectivo');
        });

        Schema::table('historial_inscripcions', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->integer('persona_id')->unsigned()->change();
            $table->integer('persona_firma_id')->unsigned()->nullable()->change();

            // ELIMINAR UUIDS
            //$table->dropUnique('historial_inscripcions_uuid_unique');
            $table->dropColumn('inscripcion_id');

            $table->renameColumn('persona_id', 'id_persona');
            $table->renameColumn('persona_firma_id', 'id_persona_firma');

            $table->renameColumn('espacio_id', 'id_espacio_academico');
            $table->renameColumn('nivel_id', 'id_nivel_procedencia');
            $table->renameColumn('modalidad_id', 'id_modalidad_procedencia');
            $table->renameColumn('escuela_id', 'id_escuela_procedencia');
            $table->renameColumn('condicion_id', 'id_condicion');

            $table->dropColumn('persona_vinculo_persona_1_id');
            $table->dropColumn('persona_vinculo_persona_2_id');
            $table->dropColumn('persona_vinculo_persona_3_id');
        });
    }
};

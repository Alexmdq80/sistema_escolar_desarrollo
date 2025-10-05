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
        Schema::table('escuela_propuesta', function (Blueprint $table) {
            //CÓDIGO QUE NO VOY A USAR
            /*$table->timestamps();
            $table->softDeletes();

            $table->renameColumn('id_escuela', 'escuela_id');
            $table->renameColumn('id_propuesta_institucional', 'propuesta_id');

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('propuesta_id')
                  ->references('id')
                  ->on('propuestas')
                  ->onDelete('restrict');
            //*********************************************** */
            //
            /// ESTA TABLA NO VA A SER MÁS NECESARIA
            // PORQUE LA RELACIÓN DE ESCUELA - PROPUESTA
            // SE VA A HACER DIRECTAMENTE DESDE LA TABLA PROPUESTA
            // HACIENDO QUE LA TABLA PROPUESTA TENGA UNA  COLUMNA escuela_id
            // Y ASÍ SE ELIMINA LA TABLA INTERMEDIA escuela_propuesta
            Schema::dropIfExists('escuela_propuesta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('escuela_propuesta', function (Blueprint $table) {
            // VUELVO A CREAR LA TABLA SIN LA CLAVES FORÁNEAS
            $table->id();
            $table->mediumInteger('id_escuela')->unsigned();
            //$table->foreign('id_escuela')->references('id')->on('escuela');
            $table->Integer('id_propuesta_institucional')->unsigned();
            //$table->foreign('id_propuesta_institucional')->references('id')->on('propuesta_institucional');
            // $table->timestamps();
        });

        /*Schema::table('escuela_propuesta', function (Blueprint $table) {
            // CÓDIGO QUE NO VOY A USAR
            // $table->timestamps();
            /$table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['propuesta_id']);

            $table->dropIndex('escuela_propuesta_escuela_id_foreign');
            $table->dropIndex('escuela_propuesta_propuesta_id_foreign');

            $table->renameColumn('escuela_id', 'id_escuela');
            $table->renameColumn('propuesta_id', 'id_propuesta_institucional');
        });*/
    }
};

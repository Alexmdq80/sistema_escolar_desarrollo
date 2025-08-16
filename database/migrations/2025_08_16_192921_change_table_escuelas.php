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
        Schema::table('escuelas', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            // * ojo que se borran los datos!!!
            $table->dropColumn('id_continente');
            $table->dropColumn('id_pais');
            $table->dropColumn('id_departamento');
            $table->dropColumn('id_provincia');

            $table->renameColumn('id_localidad_asentamiento', 'localidad_id');
            $table->renameColumn('id_ambito', 'ambito_id');
            $table->renameColumn('id_dependencia', 'dependencia_id');
            $table->renameColumn('id_sector', 'sector_id');

            $table->foreign('localidad_id')
                  ->references('id')
                  ->on('localidads')
                  ->onDelete('restrict');

            $table->foreign('ambito_id')
                  ->references('id')
                  ->on('ambitos')
                  ->onDelete('restrict');

            $table->foreign('dependencia_id')
                  ->references('id')
                  ->on('dependencias')
                  ->onDelete('restrict');

            $table->foreign('sector_id')
                  ->references('id')
                  ->on('sectors')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuelas', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropTimestamps();

            $table->smallInteger('id_departamento')->after('id')->unsigned()->nullable();
            $table->tinyInteger('id_provincia')->after('id')->unsigned()->nullable();
            $table->tinyInteger('id_pais')->after('id')->unsigned();
            $table->tinyInteger('id_continente')->after('id')->unsigned();

            $table->dropForeign(['localidad_id']);
            $table->dropForeign(['ambito_id']);
            $table->dropForeign(['dependencia_id']);
            $table->dropForeign(['sector_id']);

            $table->dropIndex('escuelas_localidad_id_foreign');
            $table->dropIndex('escuelas_ambito_id_foreign');
            $table->dropIndex('escuelas_dependencia_id_foreign');
            $table->dropIndex('escuelas_sector_id_foreign');

            $table->renameColumn('localidad_id', 'id_localidad_asentamiento');
            $table->renameColumn('ambito_id', 'id_ambito');
            $table->renameColumn('dependencia_id', 'id_dependencia');
            $table->renameColumn('sector_id', 'id_sector');
        });
    }
};

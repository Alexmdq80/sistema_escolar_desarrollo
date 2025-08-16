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
        Schema::table('calles', function (Blueprint $table) {
            $table->timestamps();

            $table->softDeletes();

            // * ojo que se borran los datos!!!
            $table->dropColumn('id_provincia');
            $table->dropColumn('id_departamento');
            $table->dropColumn('id_pais');
            $table->dropColumn('id_continente');

            $table->renameColumn('id_localidad_censal', 'localidad_censal_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');

            $table->foreign('localidad_censal_id')
                  ->references('id')
                  ->on('localidad_censals')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calles', function (Blueprint $table) {
            $table->dropForeign(['localidad_censal_id']);
            $table->dropIndex('calles_localidad_censal_id_foreign');

            $table->renameColumn('localidad_censal_id', 'id_localidad_censal');
            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');

            $table->smallInteger('id_departamento')->after('id')->unsigned()->nullable();
            $table->tinyInteger('id_provincia')->after('id')->unsigned()->nullable();
            $table->tinyInteger('id_pais')->after('id')->unsigned();
            $table->tinyInteger('id_continente')->after('id')->unsigned();

            $table->dropSoftDeletes();
            $table->dropTimestamps();
        });
    }
};

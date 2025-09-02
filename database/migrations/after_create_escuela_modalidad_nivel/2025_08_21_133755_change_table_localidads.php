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
        Schema::table('localidads', function (Blueprint $table) {
            DB::statement('ALTER TABLE localidads MODIFY id SMALLINT');
            $table->dropPrimary('id');
        });
        Schema::table('localidads', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->smallIncrements('id')->change(); // este no lo voy a revertir

            // * ojo que se borran los datos!!!
            // php artisan db:seed --class=CorregirLocalidadsSeeder
            $table->dropColumn('id_continente');
            $table->dropColumn('id_pais');
            $table->dropColumn('id_provincia');

            $table->renameColumn('id_departamento', 'departamento_id');
            $table->renameColumn('id_municipio', 'municipio_id');
            $table->renameColumn('id_localidad_censal', 'localidad_censal_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidads', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->tinyInteger('id_pais')->after('id')->unsigned();
            $table->tinyInteger('id_continente')->after('id')->unsigned();
            $table->tinyInteger('id_provincia')->after('id')->unsigned()->nullable();

            $table->renameColumn('departamento_id', 'id_departamento');
            $table->renameColumn('municipio_id', 'id_municipio');
            $table->renameColumn('localidad_censal_id', 'id_localidad_censal');
            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');
        });
    }
};

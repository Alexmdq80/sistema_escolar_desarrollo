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
        Schema::table('localidad_censals', function (Blueprint $table) {
            DB::statement('ALTER TABLE localidad_censals MODIFY id SMALLINT');
            $table->dropPrimary('id');
        });
        Schema::table('localidad_censals', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->smallIncrements('id')->change(); // este no lo voy a revertir
            // * ojo que se borran los datos!!!
            $table->dropColumn('id_continente');
            $table->dropColumn('id_pais');

            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');
            $table->renameColumn('id_funcion_georef', 'georef_funcion_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidad_censals', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();



            $table->tinyInteger('id_continente')->after('id')->unsigned();
            $table->tinyInteger('id_pais')->after('id')->unsigned();

            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');
            $table->renameColumn('georef_funcion_id', 'id_funcion_georef');

        });
    }
};

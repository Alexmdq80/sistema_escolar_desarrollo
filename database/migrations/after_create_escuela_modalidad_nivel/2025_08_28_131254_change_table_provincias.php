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
        Schema::table('provincias', function (Blueprint $table) {
            DB::statement('ALTER TABLE provincias MODIFY id TINYINT');
            $table->dropPrimary('id');
        });
        Schema::table('provincias', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->tinyIncrements('id')->change(); // este no lo voy a revertir
            // * ojo que se borran los datos!!!
            $table->dropColumn('id_continente');

            $table->renameColumn('id_pais', 'nacion_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provincias', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();


            $table->renameColumn('nacion_id', 'id_pais');
            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');

            $table->tinyInteger('id_continente')->after('id')->unsigned();
        });
    }
};

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
        Schema::table('municipios', function (Blueprint $table) {
            DB::statement('ALTER TABLE municipios MODIFY id SMALLINT');
            $table->dropPrimary('id');
        });
        Schema::table('municipios', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->smallIncrements('id')->change(); // este no lo voy a revertir

            $table->dropColumn('id_continente');
            $table->dropColumn('id_pais');

            $table->renameColumn('id_provincia', 'provincia_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipios', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

    
            $table->tinyInteger('id_continente')->after('id')->unsigned();
            $table->tinyInteger('id_pais')->after('id')->unsigned();

            $table->renameColumn('provincia_id', 'id_provincia');
            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');

        });
    }
};

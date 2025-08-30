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
            $table->timestamps();
            $table->softDeletes();
            // * ojo que se borran los datos!!!
            $table->dropColumn('id_continente');

            $table->renameColumn('id_pais', 'nacion_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');

            $table->foreign('nacion_id')
                  ->references('id')
                  ->on('nacions')
                  ->onDelete('restrict');

            $table->foreign('georef_fuente_id')
                  ->references('id')
                  ->on('georef_fuentes')
                  ->onDelete('restrict');

            $table->foreign('georef_categoria_id')
                  ->references('id')
                  ->on('georef_categorias')
                  ->onDelete('restrict');

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

            $table->dropForeign(['nacion_id']);
            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);

            $table->dropIndex('provincias_nacion_id_foreign');
            $table->dropIndex('provincias_georef_fuente_id_foreign');
            $table->dropIndex('provincias_georef_categoria_id_foreign');

            $table->renameColumn('nacion_id', 'id_pais');
            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');

            $table->tinyInteger('id_continente')->after('id')->unsigned();
        });
    }
};

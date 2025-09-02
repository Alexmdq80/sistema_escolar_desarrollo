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


            $table->dropForeign(['localidad_id']);
            $table->dropForeign(['ambito_id']);
            $table->dropForeign(['dependencia_id']);
            $table->dropForeign(['sector_id']);

            $table->dropIndex('escuelas_localidad_id_foreign');
            $table->dropIndex('escuelas_ambito_id_foreign');
            $table->dropIndex('escuelas_dependencia_id_foreign');
            $table->dropIndex('escuelas_sector_id_foreign');
    
        });

    }
};

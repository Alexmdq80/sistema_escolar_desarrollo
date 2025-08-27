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
        Schema::table('pais', function (Blueprint $table) {
            // agregar sólo si viene de un rollback
            if (Schema::hasColumn('pais', 'pais_id_continente_foreign')) {
                $table->dropForeign('pais_id_continente_foreign');
            }
            //$table->dropForeign('pais_id_continente_foreign');
        });
        Schema::table('pais', function (Blueprint $table) {
            $table->dropIndex('pais_id_continente_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pais', function (Blueprint $table) {
            $table->foreign('id_continente')->references('id')->on('continente');
        });
    }
};

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
        Schema::table('escuela_otras_ofertas', function (Blueprint $table) {
            $table->dropForeign('escuela_otras_ofertas_id_escuela_foreign');
            $table->dropForeign('escuela_otras_ofertas_id_otras_ofertas_foreign');
        });
        Schema::table('escuela_otras_ofertas', function (Blueprint $table) {
            $table->dropUnique('escuela_otras_ofertas_id_escuela_id_otras_ofertas_unique');
            $table->dropIndex('escuela_otras_ofertas_id_otras_ofertas_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_otras_ofertas', function (Blueprint $table) {
            $table->unique(['id_escuela','id_otras_ofertas']);
            $table->foreign(['id_escuela'])->references('id')->on('escuela');  
            $table->foreign(['id_otras_ofertas'])->references('id')->on('otras_ofertas');            
        });
    }
};

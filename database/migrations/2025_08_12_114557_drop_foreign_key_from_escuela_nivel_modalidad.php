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
        Schema::table('escuela_nivel_modalidad', function (Blueprint $table) {
            //$table->dropForeign('escuela_nivel_modalidad_id_escuela_foreign');
            $table->dropForeign('escuela_nivel_modalidad_id_modalidad_foreign');
            $table->dropForeign('escuela_nivel_modalidad_id_nivel_foreign');
        });
        Schema::table('escuela_nivel_modalidad', function (Blueprint $table) {
            $table->dropUnique('unique_escuela_nivel_modalidad');
            $table->dropIndex('escuela_nivel_modalidad_id_nivel_foreign');
            $table->dropIndex('escuela_nivel_modalidad_id_modalidad_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_nivel_modalidad', function (Blueprint $table) {
            $table->unique(['id_escuela','id_modalidad','id_nivel'],'unique_escuela_nivel_modalidad');
            $table->foreign(['id_nivel'])->references('id')->on('nivel');
            $table->foreign(['id_modalidad'])->references('id')->on('modalidad');
        });
    }
};

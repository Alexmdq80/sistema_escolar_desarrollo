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
        Schema::table('escuela_PI', function (Blueprint $table) {
            $table->dropForeign('escuela_pi_id_escuela_foreign');
            $table->dropForeign('escuela_pi_id_propuesta_institucional_foreign');
        });
        Schema::table('escuela_PI', function (Blueprint $table) {
            $table->dropIndex('escuela_pi_id_escuela_foreign');
            $table->dropIndex('escuela_pi_id_propuesta_institucional_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_PI', function (Blueprint $table) {
            $table->foreign(['id_escuela'])->references('id')->on('escuela');
            $table->foreign(['id_propuesta_institucional'])->references('id')->on('propuesta_institucional');
        });
    }
};

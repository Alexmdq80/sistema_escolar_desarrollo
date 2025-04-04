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
        Schema::table('inscripcion_pase', function (Blueprint $table) {
            //
            $table->dropForeign('inscripcion_pase_id_pase_motivo_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_pase', function (Blueprint $table) {
            //
            $table->foreign('id_pase_motivo')->references('id')->on('pase_motivo');

        });
    }
};

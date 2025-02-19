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
            $table->tinyInteger('id_sector')->unsigned()->nullable();
            $table->foreign('id_sector')->references('id')->on('sector');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_pase', function (Blueprint $table) {
            $table->dropForeign('inscripcion_pase_id_sector_foreign');
            $table->dropColumn('id_sector');
        });
    }
};

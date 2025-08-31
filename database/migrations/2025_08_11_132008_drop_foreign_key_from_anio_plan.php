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
        Schema::table('anio_plan', function (Blueprint $table) {
            $table->dropForeign('anio_plan_id_anio_foreign');
            $table->dropForeign('anio_plan_id_ciclo_plan_estudio_foreign');
            $table->dropForeign('anio_plan_id_plan_estudio_foreign');
        });
        Schema::table('anio_plan', function (Blueprint $table) {
            $table->dropIndex('anio_plan_id_anio_foreign');
            $table->dropIndex('anio_plan_id_ciclo_plan_estudio_foreign');
            $table->dropIndex('anio_plan_id_plan_estudio_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anio_plan', function (Blueprint $table) {
            // algunas claves hay que crearlas manualmente
            $table->foreign(['id_anio'])->references('id')->on('anio');
            //$table->foreign(['id_ciclo_plan_estudio'])->references('id')->on('ciclo_plan_estudio');
            $table->foreign(['id_plan_estudio'])->references('id')->on('plan_estudio');
        });
    }
};

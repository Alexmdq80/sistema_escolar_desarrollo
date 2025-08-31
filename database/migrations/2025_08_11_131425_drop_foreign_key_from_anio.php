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
        Schema::table('anio', function (Blueprint $table) {
            $table->dropForeign('anio_id_ciclo_plan_estudio_foreign');
        });
        Schema::table('anio', function (Blueprint $table) {
            $table->dropIndex('anio_id_ciclo_plan_estudio_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anio', function (Blueprint $table) {
            //hay que crearla manualmente
            //$table->foreign(['id_ciclo_plan_estudio'])->references('id')->on('ciclo_plan_estudio');
        });
    }
};

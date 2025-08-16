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
        Schema::table('anios', function (Blueprint $table) {
            $table->softDeletes();
            // * ojo que se borran los datos!!!
            $table->dropColumn('id_ciclo_plan_estudio');
            /*$table->renameColumn('id_ciclo_plan_estudio', 'plan_ciclo_id');
            $table->foreign('plan_ciclo_id')
                  ->references('id')
                  ->on('plan_ciclos')
                  ->onDelete('restrict');*/
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anios', function (Blueprint $table) {
            /*$table->dropForeign(['plan_ciclo_id']);
            $table->dropIndex('anios_plan_ciclo_id_foreign');
            $table->renameColumn('plan_ciclo_id', 'id_ciclo_plan_estudio');*/
            $table->tinyInteger('id_ciclo_plan_estudio')->after('id')->unsigned();
            $table->dropSoftDeletes();
        });
    }
};

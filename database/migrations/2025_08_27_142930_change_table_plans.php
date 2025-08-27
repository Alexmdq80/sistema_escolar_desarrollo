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
        Schema::table('plans', function (Blueprint $table) {
            $table->softDeletes();

            $table->renameColumn('id_ciclo_plan_estudio', 'plan_ciclo_id');

            $table->foreign('plan_ciclo_id')
                  ->references('id')
                  ->on('plan_ciclos')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropForeign(['plan_ciclo_id']);

            $table->dropIndex('plans_plan_ciclo_id_foreign');

            $table->renameColumn('plan_ciclo_id', 'id_ciclo_plan_estudio');

        });
    }
};

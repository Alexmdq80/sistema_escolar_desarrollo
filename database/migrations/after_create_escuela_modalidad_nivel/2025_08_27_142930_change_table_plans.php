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


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropSoftDeletes();



            $table->renameColumn('plan_ciclo_id', 'id_ciclo_plan_estudio');

        });
    }
};

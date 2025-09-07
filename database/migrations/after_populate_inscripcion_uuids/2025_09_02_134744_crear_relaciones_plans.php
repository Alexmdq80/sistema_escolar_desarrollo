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

            $table->dropForeign(['plan_ciclo_id']);

            $table->dropIndex('plans_plan_ciclo_id_foreign');
    
        });

    }
};

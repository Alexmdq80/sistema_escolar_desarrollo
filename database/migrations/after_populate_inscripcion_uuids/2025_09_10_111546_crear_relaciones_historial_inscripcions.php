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
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            $table->foreign('inscripcion_id')
                  ->references('id')
                  ->on('inscripcions')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_inscripcions', function (Blueprint $table) {
            $table->dropForeign(['inscripcion_id']);

            $table->dropIndex('historial_inscripcions_inscripcion_id_foreign');
        });
    }
};

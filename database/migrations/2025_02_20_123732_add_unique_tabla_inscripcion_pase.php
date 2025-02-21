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
            $table->unsignedInteger('id_inscripcion_historial')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_pase', function (Blueprint $table) {
        //  $table->unsignedInteger('id_inscripcion_historial')->index()->change();
        });

        Schema::table('inscripcion_pase', function (Blueprint $table) {
        //   $table->dropUnique('inscripcion_pase_id_inscripcion_historial_unique');
        //    $table->renameIndex('inscripcion_pase_id_inscripcion_historial_index', 'inscripcion_pase_id_inscripcion_historial_foreign');
          });

    }
};

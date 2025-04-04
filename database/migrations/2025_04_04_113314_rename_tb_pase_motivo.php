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
        Schema::rename('pase_motivo', 'salida_motivo');
      //  Schema::table('pase_motivo', function (Blueprint $table) {
            //
      //  });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('salida_motivo', 'pase_motivo');
      //  Schema::table('pase_motivo', function (Blueprint $table) {
            //
      //  });
    }
};

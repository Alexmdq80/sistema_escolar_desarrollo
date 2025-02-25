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
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
         });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
           $table->dropPrimary('id');
        });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->id('id')->change();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();
         });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->dropPrimary('id');
         });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->increments('id')->change();
        });
    }
};

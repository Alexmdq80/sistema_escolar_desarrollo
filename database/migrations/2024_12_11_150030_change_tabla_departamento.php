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
        Schema::table('departamento', function (Blueprint $table) {
            $table->unsignedtinyInteger('id_region_numero')->nullable();
            $table->foreign('id_region_numero')->references('id')->on('region_educativa');
            $table->unsignedsmallInteger('distrito_numero')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento', function (Blueprint $table) {
            //
        });
    }
};

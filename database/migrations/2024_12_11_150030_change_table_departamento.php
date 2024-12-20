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
            $table->unsignedtinyInteger('id_region_educativa')->nullable();
            $table->foreign('id_region_educativa')->references('id')->on('region_educativa');
            $table->unsignedsmallInteger('distrito_numero')->unique()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento', function (Blueprint $table) {
            $table->dropForeign('departamento_id_region_educativa_foreign');
            $table->dropColumn('id_region_educativa');
            $table->dropUnique('departamento_distrito_numero_unique');
            $table->dropColumn('distrito_numero');
        });
    }
};

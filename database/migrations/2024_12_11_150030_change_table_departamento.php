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
            $table->unsignedtinyInteger('region_numero')->index()->nullable();
            $table->unsignedsmallInteger('distrito_numero')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento', function (Blueprint $table) {
            $table->dropIndex('departamento_region_numero_index');
            $table->dropColumn('region_numero');
            $table->dropUnique('departamento_distrito_numero_unique');
            $table->dropColumn('distrito_numero');
        });
    }
};

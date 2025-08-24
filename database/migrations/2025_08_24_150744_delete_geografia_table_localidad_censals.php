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
        Schema::table('localidad_censals', function (Blueprint $table) {
            // * ojo que se borran los datos!!!

            $table->dropColumn('id_provincia');
            $table->dropColumn('id_municipio');
            $table->dropColumn('id_departamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidad_censals', function (Blueprint $table) {
            $table->tinyInteger('id_provincia')->after('id')->unsigned()->nullable();
            $table->smallInteger('id_departamento')->after('id_provincia')->unsigned()->nullable();
            $table->smallInteger('id_municipio')->after('id_departamento')->unsigned()->nullable();

        });
    }
};

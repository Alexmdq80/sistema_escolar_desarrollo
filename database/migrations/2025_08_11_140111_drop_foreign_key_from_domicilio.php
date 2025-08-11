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
        Schema::table('domicilio', function (Blueprint $table) {

            $table->dropForeign('domicilio_id_persona_foreign');
            $table->dropForeign('domicilio_id_calle_foreign');
            $table->dropForeign('domicilio_id_calle_entre1_foreign');
            $table->dropForeign('domicilio_id_calle_entre2_foreign');
            $table->dropForeign('domicilio_id_pais_foreign');
            $table->dropForeign('domicilio_id_provincia_foreign');
            $table->dropForeign('domicilio_id_departamento_foreign');
            $table->dropForeign('domicilio_id_localidad_asentamiento_foreign');

        });
        Schema::table('domicilio', function (Blueprint $table) {
            $table->dropUnique('domicilio_id_persona_unique');
            $table->dropIndex('domicilio_id_calle_foreign');
            $table->dropIndex('domicilio_id_calle_entre1_foreign');
            $table->dropIndex('domicilio_id_calle_entre2_foreign');
            $table->dropIndex('domicilio_id_pais_foreign');
            $table->dropIndex('domicilio_id_provincia_foreign');
            $table->dropIndex('domicilio_id_departamento_foreign');
            $table->dropIndex('domicilio_id_localidad_asentamiento_foreign');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domicilio', function (Blueprint $table) {
            $table->unique('id_persona');
            $table->foreign(['id_calle'])->references('id')->on('calle');
            $table->foreign(['id_calle_entre1'])->references('id')->on('calle');
            $table->foreign(['id_calle_entre2'])->references('id')->on('calle');
            $table->foreign(['id_pais'])->references('id')->on('pais');
            $table->foreign(['id_provincia'])->references('id')->on('provincia');
            $table->foreign(['id_departamento'])->references('id')->on('departamento');
            $table->foreign(['id_localidad_asentamiento'])->references('id')->on('localidad_asentamiento');
        });
    }
};

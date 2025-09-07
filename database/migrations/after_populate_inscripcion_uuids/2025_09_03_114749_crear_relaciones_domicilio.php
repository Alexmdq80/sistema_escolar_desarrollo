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
        Schema::table('domicilios', function (Blueprint $table) {
            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');

            $table->foreign('localidad_id')
                  ->references('id')
                  ->on('localidads')
                  ->onDelete('restrict');

            $table->foreign('calle_id')
                  ->references('id')
                  ->on('calles')
                  ->onDelete('restrict');

            $table->foreign('calle_entre_1_id')
                  ->references('id')
                  ->on('calles')
                  ->onDelete('restrict');

            $table->foreign('calle_entre_2_id')
                  ->references('id')
                  ->on('calles')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domicilios', function (Blueprint $table) {

            $table->dropForeign(['persona_id']);
            $table->dropForeign(['localidad_id']);
            $table->dropForeign(['calle_id']);
            $table->dropForeign(['calle_entre_1_id']);
            $table->dropForeign(['calle_entre_2_id']);

            $table->dropIndex('domicilios_persona_id_foreign');
            $table->dropIndex('domicilios_localidad_id_foreign');
            $table->dropIndex('domicilios_calle_id_foreign');
            $table->dropIndex('domicilios_calle_entre_1_id_foreign');
            $table->dropIndex('domicilios_calle_entre_2_id_foreign');
    
        });

    }
};

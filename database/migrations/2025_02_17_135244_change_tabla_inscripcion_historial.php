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
            // VOY A USAR DE CLAVE id_persona y el id_de vínculo en vez de EAV
            $table->unsignedInteger('id_persona_adulto_1')->nullable()->comment('ID de persona del primer adulto responsable que figura en la inscripción.');
            $table->foreign('id_persona_adulto_1')->references('id')->on('persona');
            $table->tinyInteger('id_adulto_vinculo_1')->unsigned()->nullable();
            $table->foreign('id_adulto_vinculo_1')->references('id')->on('adulto_vinculo');
            $table->unsignedInteger('id_persona_adulto_2')->nullable()->comment('ID de persona del segundo adulto responsable que figura en la inscripción.');
            $table->foreign('id_persona_adulto_2')->references('id')->on('persona');
            $table->tinyInteger('id_adulto_vinculo_2')->unsigned()->nullable();
            $table->foreign('id_adulto_vinculo_2')->references('id')->on('adulto_vinculo');
            $table->unsignedInteger('id_persona_adulto_3')->nullable()->comment('ID de persona del restringido que figura en la inscripción.');
            $table->foreign('id_persona_adulto_3')->references('id')->on('persona');
            $table->tinyInteger('id_adulto_vinculo_3')->unsigned()->nullable();
            $table->foreign('id_adulto_vinculo_3')->references('id')->on('adulto_vinculo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->dropForeign('inscripcion_historial_id_persona_adulto_1_foreign');
            $table->dropColumn('id_persona_adulto_1');
            $table->dropForeign('inscripcion_historial_id_persona_adulto_2_foreign');
            $table->dropColumn('id_persona_adulto_2');
            $table->dropForeign('inscripcion_historial_id_persona_adulto_3_foreign');
            $table->dropColumn('id_persona_adulto_3');
            $table->dropForeign('inscripcion_historial_id_adulto_vinculo_1_foreign');
            $table->dropColumn('id_adulto_vinculo_1');
            $table->dropForeign('inscripcion_historial_id_adulto_vinculo_2_foreign');
            $table->dropColumn('id_adulto_vinculo_2');
            $table->dropForeign('inscripcion_historial_id_adulto_vinculo_3_foreign');
            $table->dropColumn('id_adulto_vinculo_3');
        });
    }
};

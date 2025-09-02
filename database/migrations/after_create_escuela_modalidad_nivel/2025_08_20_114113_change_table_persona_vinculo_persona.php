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
        Schema::table('persona_vinculo_persona', function (Blueprint $table) {
            $table->softDeletes();
            // REUBICAR COLUMNAS / MODIFICAR
            $table->unsignedBigInteger('id_persona_estudiante')->change();
            $table->unsignedBigInteger('id_persona_adulto')->change();

            $table->renameColumn('id_persona_estudiante', 'persona_estudiante_id');
            $table->renameColumn('id_persona_adulto', 'persona_adulto_id');
            $table->renameColumn('id_adulto_vinculo', 'vinculo_id');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persona_vinculo_persona', function (Blueprint $table) {
            $table->dropSoftDeletes();

        });


        Schema::table('persona_vinculo_persona', function (Blueprint $table) {
            // REUBICAR COLUMNAS / MODIFICAR
            $table->integer('persona_estudiante_id')->unsigned()->change();
            $table->integer('persona_adulto_id')->unsigned()->change();

            $table->renameColumn('persona_estudiante_id', 'id_persona_estudiante');
            $table->renameColumn('persona_adulto_id', 'id_persona_adulto');
            $table->renameColumn('vinculo_id', 'id_adulto_vinculo');

        });
    }
};

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

            $table->renameColumn('id_persona_estudiante', 'persona_estudiante_id');
            $table->renameColumn('id_persona_adulto', 'persona_adulto_id');
            $table->renameColumn('id_adulto_vinculo', 'vinculo_id');

            $table->foreign('persona_estudiante_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');
                  
            $table->foreign('persona_adulto_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');

            $table->foreign('vinculo_id')
                  ->references('id')
                  ->on('vinculos')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persona_vinculo_persona', function (Blueprint $table) {
            $table->dropSoftDeletes();

            $table->dropForeign(['persona_estudiante_id']);
            $table->dropForeign(['persona_adulto_id']);
            $table->dropForeign(['vinculo_id']);

            $table->dropIndex('persona_vinculo_persona_persona_adulto_id_foreign');
            $table->dropIndex('persona_vinculo_persona_persona_estudiante_id_foreign');
            $table->dropIndex('persona_vinculo_persona_vinculo_id_foreign');            

            $table->renameColumn('persona_estudiante_id', 'id_persona_estudiante');
            $table->renameColumn('persona_adulto_id', 'id_persona_adulto');
            $table->renameColumn('vinculo_id', 'id_adulto_vinculo');

        });
    }
};

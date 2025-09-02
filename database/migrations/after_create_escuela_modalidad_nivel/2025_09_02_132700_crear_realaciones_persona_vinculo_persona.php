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

            $table->dropForeign(['persona_estudiante_id']);
            $table->dropForeign(['persona_adulto_id']);
            $table->dropForeign(['vinculo_id']);

            $table->dropIndex('persona_vinculo_persona_persona_adulto_id_foreign');
            $table->dropIndex('persona_vinculo_persona_persona_estudiante_id_foreign');
            $table->dropIndex('persona_vinculo_persona_vinculo_id_foreign');
        });
    }
};

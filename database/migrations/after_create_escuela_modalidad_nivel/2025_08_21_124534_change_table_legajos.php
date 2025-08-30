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
        Schema::table('legajos', function (Blueprint $table) {
            $table->softDeletes();

            $table->renameColumn('id_persona', 'persona_id');
            $table->renameColumn('id_escuela', 'escuela_id');

            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onDelete('restrict');     

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->unique(['persona_id', 'escuela_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legajos', function (Blueprint $table) {
            $table->dropSoftDeletes();
      
            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['persona_id']);

            $table->dropUnique('legajos_persona_id_escuela_id_unique');

            $table->dropIndex('legajos_escuela_id_foreign');
            //$table->dropIndex('legajos_persona_id_foreign');

            $table->renameColumn('persona_id', 'id_persona');
            $table->renameColumn('escuela_id', 'id_escuela');

        });
    }
};

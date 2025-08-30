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
        Schema::table('escuela_propuesta', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->renameColumn('id_escuela', 'escuela_id');
            $table->renameColumn('id_propuesta_institucional', 'propuesta_id');

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('propuesta_id')
                  ->references('id')
                  ->on('propuestas')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_propuesta', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['propuesta_id']);

            $table->dropIndex('escuela_propuesta_escuela_id_foreign');
            $table->dropIndex('escuela_propuesta_propuesta_id_foreign');

            $table->renameColumn('escuela_id', 'id_escuela');
            $table->renameColumn('propuesta_id', 'id_propuesta_institucional');

        });
    }
};

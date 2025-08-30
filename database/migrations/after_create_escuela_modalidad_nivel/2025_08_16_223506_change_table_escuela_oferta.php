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
        Schema::table('escuela_oferta', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->renameColumn('id_escuela', 'escuela_id');
            $table->renameColumn('id_otras_ofertas', 'oferta_id');

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('oferta_id')
                  ->references('id')
                  ->on('ofertas')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_oferta', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['oferta_id']);

            $table->dropIndex('escuela_oferta_escuela_id_foreign');
            $table->dropIndex('escuela_oferta_oferta_id_foreign');

            $table->renameColumn('escuela_id', 'id_escuela');
            $table->renameColumn('oferta_id', 'id_otras_ofertas');

        });
    }
};

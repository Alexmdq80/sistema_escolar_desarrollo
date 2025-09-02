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
        Schema::table('escuela_ofertas', function (Blueprint $table) {
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
        Schema::table('escuela_ofertas', function (Blueprint $table) {

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['oferta_id']);

            $table->dropIndex('escuela_oferta_escuela_id_foreign');
            $table->dropIndex('escuela_oferta_oferta_id_foreign');
    
        });

    }
};

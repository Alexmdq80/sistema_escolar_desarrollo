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
        Schema::table('usuario_escuela', function (Blueprint $table) {
            $table->dropForeign('usuario_escuela_id_escuela_foreign');
            $table->dropForeign('usuario_escuela_id_usuario_tipo_foreign');
        });
        Schema::table('usuario_escuela', function (Blueprint $table) {
            $table->dropIndex('usuario_escuela_id_escuela_foreign');
            $table->dropIndex('usuario_escuela_id_usuario_tipo_foreign');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            $table->foreign('id_escuela')->references('id')->on('escuela');
            $table->foreign('id_usuario_tipo')->references('id')->on('usuario_tipo');
        });
    }
};

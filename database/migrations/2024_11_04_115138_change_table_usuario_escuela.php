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
            // QUITAR ES_ADMIM
            if (Schema::hasColumn('usuario_escuela', 'es_admin')) {
                $table->dropColumn('es_admin');
            }
            // AGREGAR ID_USUARIO_TIPO
            if (!Schema::hasColumn('usuario_escuela', 'id_usuario_tipo')) {
                $table->tinyInteger('id_usuario_tipo')->unsigned()->default(5);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            //
            if (Schema::hasColumn('usuario_escuela', 'id_usuario_tipo')) {
                $table->dropColumn('id_usuario_tipo');
            }
            if (!Schema::hasColumn('usuario_escuela', 'es_admin')) {
                $table->boolean('es_admin');
            }
        });
    }
};

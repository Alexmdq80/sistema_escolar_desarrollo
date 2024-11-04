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
        Schema::table('users', function (Blueprint $table) {
        // QUITAR ES_ADMIM Y ID_USUARIO_TIPO EN CASO DE QUE EXISTAN
            if (Schema::hasColumn('users', 'es_admin')) {
                $table->dropColumn('es_admin');
            }
            if (Schema::hasColumn('users', 'id_usuario_tipo')) {
                $table->dropColumn('id_usuario_tipo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

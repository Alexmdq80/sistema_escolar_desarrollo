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
            // Elimina la clave foránea usando el nombre exacto
            //************************************************************************* */
            // LA CLAV DE LA ESCUELA LO DEJO PARA DESPUÉS, ES MÁS COMPLEJO
            //$table->dropForeign('usuario_escuela_id_escuela_foreign');
            $table->dropForeign('usuario_escuela_id_usuario_foreign');
            //$table->dropForeign('usuario_escuela_id_usuario_tipo_foreign');
        });
        Schema::table('usuario_escuela', function (Blueprint $table) {
            $table->dropIndex('usuario_escuela_id_usuario_foreign');
            //$table->dropIndex('usuario_escuela_id_usuario_tipo_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::table('usuario_escuela', function (Blueprint $table) {
        //    $table->index('id_usuario', 'usuario_escuela_id_usuario_foreign');
       // });
        Schema::table('usuario_escuela', function (Blueprint $table) {
            $table->foreign('id_usuario')->references('id')->on('usuario');
                //->name('fk_usuario_escuela_id_usuario_foreign');
            //$table->foreign('id_usuario_tipo')->references('id')->on('usuario_tipo')
            //    ->name('usuario_escuela_id_usuario_tipo_foreign');
        });
    }
};

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
        Schema::table('escuela_usuario', function (Blueprint $table) {
            $table->tinyInteger('id_usuario_tipo')->unsigned()->after('id_usuario')->change();

            $table->renameColumn('id_escuela', 'escuela_id');
            $table->renameColumn('id_usuario', 'usuario_id');
            $table->renameColumn('id_usuario_tipo', 'usuario_tipo_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_usuario', function (Blueprint $table) {


            $table->renameColumn('escuela_id', 'id_escuela');
            $table->renameColumn('usuario_id', 'id_usuario');
            $table->renameColumn('usuario_tipo_id', 'id_usuario_tipo');

        });
    }
};

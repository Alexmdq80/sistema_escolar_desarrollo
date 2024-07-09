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
        Schema::create('usuario_escuela', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->mediumInteger('id_escuela')->unsigned();
            $table->foreign('id_escuela')->references('id')->on('escuela');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->boolean('es_admin');
            $table->boolean('verificado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_escuela');
    }
};

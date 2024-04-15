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
        Schema::create('usuario', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->integer('id_persona')->unsigned()->unique();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->string('nombre', 25);
            $table->string('clave', 255);
            $table->boolean('es_admin');
            $table->tinyInteger('orden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};

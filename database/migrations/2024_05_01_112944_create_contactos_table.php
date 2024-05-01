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
        Schema::create('contacto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona')->unsigned()->unique();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->string('telefono_codigo_area', 5)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('celular_codigo_area', 5)->nullable();
            $table->string('celular', 50)->nullable();
            $table->string('email', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacto');
    }
};

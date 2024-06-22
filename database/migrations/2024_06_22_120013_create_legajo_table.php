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
        Schema::create('legajo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona')->unsigned()->unique();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->integer('libro')->unsigned();
            $table->integer('folio')->unsigned();
            $table->integer('legajo')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legajo');
    }
};

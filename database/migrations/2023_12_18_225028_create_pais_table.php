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
        if (!Schema::hasTable('pais')) {
            Schema::create('pais', function (Blueprint $table) {
                $table->tinyInteger('id')->unsigned()->primary();
                $table->string('id_georef', 3)->nullable();
                $table->tinyInteger('id_continente')->unsigned();
                $table->foreign('id_continente')->references('id')->on('continente'); 
                $table->string('nombre', 25);
                $table->string('nacionalidad', 30)->nullable();
            
            });

        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     //   Schema::dropIfExists('pais');
    }
};

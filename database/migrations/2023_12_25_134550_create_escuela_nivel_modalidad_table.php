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
        if (!Schema::hasTable('escuela_nivel_modalidad')) {
            Schema::create('escuela_nivel_modalidad', function (Blueprint $table) {
                $table->id();
                $table->mediumInteger('id_escuela')->unsigned();
                $table->foreign('id_escuela')->references('id')->on('escuela');
                $table->tinyInteger('id_nivel')->unsigned();
                $table->foreign('id_nivel')->references('id')->on('nivel');
                $table->tinyInteger('id_modalidad')->unsigned();
                $table->foreign('id_modalidad')->references('id')->on('modalidad');
                $table->unique(['id_escuela','id_nivel','id_modalidad']);
                // $table->timestamps();
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('escuela_nivel_modalidad');
    }
};

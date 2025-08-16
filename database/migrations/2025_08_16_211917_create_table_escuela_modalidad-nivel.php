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
        Schema::create('escuela_modalidad_nivel', function (Blueprint $table) {
            $table->increments('id');

            $table->mediumInteger('escuela_id')->unsigned();
            $table->smallInteger('modalidad_nivel_id')->unsigned();

            $table->foreign('escuela_id')
                ->references('id')
                ->on('escuelas')
                ->onDelete('restrict');

            $table->foreign('modalidad_nivel_id')
                ->references('id')
                ->on('modalidad_nivel')
                ->onDelete('restrict');

            $table->unique(['escuela_id', 'modalidad_nivel_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuela_modalidad_nivel');
    }
};

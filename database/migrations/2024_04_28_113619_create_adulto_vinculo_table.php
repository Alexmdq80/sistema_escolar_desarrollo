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
        Schema::create('adulto_vinculo', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->tinyInteger('id_vinculo_tipo')->unsigned();
            $table->foreign('id_vinculo_tipo')->references('id')->on('vinculo_tipo');
            $table->string('nombre', 60);
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adulto_vinculo');
    }
};

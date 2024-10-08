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
        Schema::create('ciclo_lectivo', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->year('nombre');
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->boolean('cerrado');
            //  $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclo_lectivo');
    }
};

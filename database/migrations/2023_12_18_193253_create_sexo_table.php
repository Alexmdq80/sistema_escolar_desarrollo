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
        Schema::create('sexo', function (Blueprint $table) {
          //  $table->id();      
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('nombre', 15);
            $table->string('letra', 1);
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
        Schema::dropIfExists('sexo');
    }
};

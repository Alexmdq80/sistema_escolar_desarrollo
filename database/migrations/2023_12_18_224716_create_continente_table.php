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

        if (!Schema::hasTable('continente')) {
         
             Schema::create('continente', function (Blueprint $table) {
            
            
                $table->tinyInteger('id')->unsigned()->primary();
                $table->string('nombre', 50);
                $table->tinyInteger('orden');     
          
            });

          /*  $table->timestamps(); */
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Schema::dropIfExists('continente');
    }
};

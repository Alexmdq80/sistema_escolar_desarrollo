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
        if (!Schema::hasTable('fuente_georef')) {
            Schema::create('fuente_georef', function (Blueprint $table) {
                $table->tinyInteger('id')->unsigned()->primary();
                $table->string('nombre', 70);
                $table->tinyInteger('orden');
                $table->boolean('vigente');
                // $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('fuente_georef');
    }
};

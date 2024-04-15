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

        if (!Schema::hasTable('escuela_otras_ofertas')) {
            Schema::create('escuela_otras_ofertas', function (Blueprint $table) {
                $table->id();
                $table->mediumInteger('id_escuela')->unsigned();
                $table->foreign('id_escuela')->references('id')->on('escuela');
                $table->tinyInteger('id_otras_ofertas')->unsigned();
                $table->foreign('id_otras_ofertas')->references('id')->on('otras_ofertas');
                $table->unique(['id_escuela','id_otras_ofertas']);
                // $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('escuela_otras_ofertas');
    }
};

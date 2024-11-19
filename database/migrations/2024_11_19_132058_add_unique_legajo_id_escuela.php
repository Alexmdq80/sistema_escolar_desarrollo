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
        Schema::table('legajo', function (Blueprint $table) {
            //
           $table->unique(['id_persona', 'id_escuela']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('legajo', function (Blueprint $table) {
            //
            $table->dropUnique('legajo_id_persona_id_escuela_unique');
        });
    }
};

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
        Schema::table('contacto', function (Blueprint $table) {
            $table->dropForeign('contacto_id_persona_foreign');
        });

        Schema::table('contacto', function (Blueprint $table) {
            $table->dropUnique(['id_persona']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacto', function (Blueprint $table) {
            $table->unique('id_persona');
            $table->foreign(['id_persona'])->references('id')->on('persona');
        });
    }
};

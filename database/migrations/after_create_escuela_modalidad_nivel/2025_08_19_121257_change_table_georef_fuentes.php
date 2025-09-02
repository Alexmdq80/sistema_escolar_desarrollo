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
        Schema::table('georef_fuentes', function (Blueprint $table) {
            DB::statement('ALTER TABLE georef_fuentes MODIFY id TINYINT');
            $table->dropPrimary('id');
        });
        Schema::table('georef_fuentes', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->tinyIncrements('id')->change(); // este no lo voy a revertir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('georef_fuentes', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
};

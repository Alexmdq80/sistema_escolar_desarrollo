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
        Schema::table('regions', function (Blueprint $table) {
            DB::statement('ALTER TABLE regions MODIFY id TINYINT');
            $table->dropPrimary('id');
        });
        Schema::table('regions', function (Blueprint $table) {
            $table->unsignedTinyInteger('numero')->after('id');
        });
        
        DB::statement('UPDATE regions SET numero = id');

        Schema::table('regions', function (Blueprint $table) {
            $table->softDeletes();
            $table->tinyIncrements('id')->change();
            $table->unique(['numero']); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropUnique(['numero']);

            $table->dropColumn('numero');
        });
    }
};

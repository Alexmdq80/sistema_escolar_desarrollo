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
        Schema::table('inscripcions', function (Blueprint $table) {
            $table->softDeletes();
            $table->uuid('inscripcion_id')->nullable()->unique()->after('id');
        });

        // call artisan command to populate existing records with uuids
        Artisan::call('populate:inscripcion-uuids');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcions', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropUnique('inscripcions_inscripcion_id_unique');
            $table->dropColumn('inscripcion_id');
        });
    }
};

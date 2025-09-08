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
            //$table->softDeletes();
            $table->uuid('uuid')->nullable()->unique()->after('id');
        });
        Artisan::call('populate:inscripcion-uuids');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcions', function (Blueprint $table) {
            //$table->dropSoftDeletes();
            $table->dropUnique('inscripcions_uuid_unique');
            $table->dropColumn('uuid');
        });
    }
};

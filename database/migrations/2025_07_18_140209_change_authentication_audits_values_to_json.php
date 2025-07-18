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
        Schema::table('authentication_audits', function (Blueprint $table) {
            $table->json('old_values')->nullable()->change(); // Mantén nullable si lo era
            $table->json('new_values')->nullable()->change(); // Mantén nullable si lo era
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authentication_audits', function (Blueprint $table) {
            $table->text('old_values')->nullable()->change();
            $table->text('new_values')->nullable()->change();
        });
    }
};

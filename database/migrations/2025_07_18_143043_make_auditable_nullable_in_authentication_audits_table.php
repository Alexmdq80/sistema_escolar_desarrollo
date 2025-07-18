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
            $table->string('auditable_type')->nullable()->change(); // Permitir NULL
            $table->unsignedBigInteger('auditable_id')->nullable()->change(); // Permitir NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authentication_audits', function (Blueprint $table) {
            // Si quieres revertir, asegúrate de que no haya nulos antes de hacerlo NOT NULL
            $table->string('auditable_type')->change();
            $table->unsignedBigInteger('auditable_id')->change();
        });
    }
};

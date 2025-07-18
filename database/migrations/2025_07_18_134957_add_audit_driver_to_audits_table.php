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
        Schema::table('audits', function (Blueprint $table) {
            // Si la columna ya existe por alguna razón, puedes añadir un `if not exists`
            // o simplemente ejecutarla y Laravel se encargará si ya está.
            $table->string('audit_driver', 60)->nullable()->after('tags'); // O después de cualquier columna existente. 'tags' es un buen lugar.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->dropColumn('audit_driver');
        });
    }
};

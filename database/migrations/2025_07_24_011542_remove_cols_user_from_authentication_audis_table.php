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
            $table->dropColumn('user_type');
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authentication_audits', function (Blueprint $table) {
            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }
};

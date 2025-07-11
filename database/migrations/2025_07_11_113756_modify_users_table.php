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
        Schema::table('usuario', function (Blueprint $table) {
            //
            $table->dropColumn('clave');

            $table->timestamp('email_set_at')->nullable()->useCurrent();
            $table->unsignedInteger('email_correction_attempts')->default(0);

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            //
            $table->dropColumn('email_set_at');
            $table->dropColumn('email_correction_attempts');
            $table->string('clave', 255);
            $table->dropSoftDeletes();
        });
    }
};

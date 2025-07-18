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
     // Hacer auditable_type nullable en la tabla 'audits'
            $table->string('auditable_type')->nullable()->change();
            // Si auditable_id es BIGINT y tu user_id es UUID, también hazlo CHAR(36) y nullable
            // Si la tabla 'audits' ya fue creada, esta línea podría necesitar el ->change()
            $table->string('auditable_id', 36)->nullable()->change(); // Usa string/char(36) para UUID
            // Si la tabla 'audits' tiene un 'user_id' que no es UUID, NO lo cambies a CHAR(36) aquí.
            // Pero si también auditas cosas con UUIDs en la tabla 'audits', entonces:
            // $table->string('user_id', 36)->nullable()->change(); // O el tipo de dato que corresponda
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audits', function (Blueprint $table) {
            // Puedes definir cómo revertir, o dejarlo vacío si no planeas revertir.
            // $table->string('auditable_type')->nullable(false)->change();
            // $table->unsignedBigInteger('auditable_id')->nullable(false)->change();
        });
    }
};

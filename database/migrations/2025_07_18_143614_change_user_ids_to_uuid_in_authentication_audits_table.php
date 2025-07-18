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
            // Si 'user_id' existe y es BIGINT, cámbialo a CHAR(36)
            // Usamos 'char' porque los UUIDs tienen una longitud fija de 36 caracteres.
            $table->char('user_id', 36)->nullable()->change();

            // Y MUY IMPORTANTE: 'auditable_id' también debe poder almacenar UUIDs.
            // Si la columna auditable_id fue creada por $table->morphs('auditable');,
            // entonces su tipo se basa en el ID del modelo padre.
            // Necesitas asegurarte de que también sea CHAR(36)
            $table->char('auditable_id', 36)->nullable()->change();

            // Si tu migración original usaba $table->morphs('auditable'),
            // eso ya maneja 'auditable_type' y 'auditable_id'.
            // Solo necesitamos cambiar el tipo de 'auditable_id'.
            // La columna 'auditable_type' es string, ya es compatible.
            $table->string('auditable_type')->nullable()->change(); // Asegurar que sea nullable si no lo es
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authentication_audits', function (Blueprint $table) {
            // Revertir a los tipos originales si es necesario
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedBigInteger('auditable_id')->nullable()->change();
            $table->string('auditable_type')->nullable(false)->change(); // Si originalmente no era nullable
        });
    }
};

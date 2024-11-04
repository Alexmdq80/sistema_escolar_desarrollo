<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Usuario;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inscripcion', function (Blueprint $table) {
                // ELIMINO LA RELACIÓN CON USUARIO
                $table->dropForeign('inscripcion_id_usuario_foreign');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion', function (Blueprint $table) {
            //  REVIERTO LA RESTRICCIÓN
            $usuario = new Usuario;
            $existe = $usuario::count();
            if (!$existe) {
                $usuario->nombre_usuario = "alex";
                $usuario->nombre = "ALEX JAVIER";
                $usuario->apellido = "ACTIS LOBOS";
                $usuario->clave = '1234';
                $usuario->save();
            }
            $table->foreign('id_usuario')->references('id')->on('usuario');
        });
    }
};

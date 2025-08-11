<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    /*    Schema::table('users', function (Blueprint $table) {
            $table->boolean('es_admin')->default(false);

        });
        //CREAR USUARIO
        $usuario = new Usuario();
        $usuario->name = 'admin';
        $usuario->email = 'admin@admin';
        $usuario->password = Hash::make('admin');
        $usuario->es_admin = true;
        $usuario->save();*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
           /* $table->dropColumn('es_admin');*/
        });
    }
};

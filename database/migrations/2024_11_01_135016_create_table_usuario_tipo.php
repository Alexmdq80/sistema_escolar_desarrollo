<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Usuario_Tipo;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        {
            if (!Schema::hasTable('usuario_tipo')) {
                Schema::create('usuario_tipo', function (Blueprint $table) {
                    $table->tinyInteger('id')->unsigned()->primary();
                    $table->string('nombre', 30);
                    $table->tinyInteger('orden');
                    $table->boolean('vigente');
                    $table->timestamps();
                });
            }
//CREAR TIPOS - NO SÉ SI FUNCIONARÍA EN LA MISMA MIGRACIÓN...
            $usuario_tipo = new Usuario_Tipo();
            $existe = $usuario_tipo->count();
            if (!$existe) {
                $usuario_tipo = new Usuario_Tipo();
                $usuario_tipo->id = 1;
                $usuario_tipo->nombre = 'root';
                $usuario_tipo->orden = 0;
                $usuario_tipo->vigente = true;
                $usuario_tipo->save();

                $usuario_tipo = new Usuario_Tipo();
                $usuario_tipo->id = 2;
                $usuario_tipo->nombre = 'admin_full';
                $usuario_tipo->orden = 10;
                $usuario_tipo->vigente = true;
                $usuario_tipo->save();

                $usuario_tipo = new Usuario_Tipo();
                $usuario_tipo->id = 3;
                $usuario_tipo->nombre = 'admin_plus';
                $usuario_tipo->orden = 20;
                $usuario_tipo->vigente = true;
                $usuario_tipo->save();

                $usuario_tipo = new Usuario_Tipo();
                $usuario_tipo->id = 4;
                $usuario_tipo->nombre = 'admin';
                $usuario_tipo->orden = 30;
                $usuario_tipo->vigente = true;
                $usuario_tipo->save();


                $usuario_tipo = new Usuario_Tipo();
                $usuario_tipo->id = 5;
                $usuario_tipo->nombre = 'standard';
                $usuario_tipo->orden = 40;
                $usuario_tipo->vigente = true;
                $usuario_tipo->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_tipo', function (Blueprint $table) {
            // ESTA NO ES NECESARIO REVERTIRLA...
        });
    }
};

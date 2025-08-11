<?php

namespace Database\Seeders;

use App\Models\UsuarioEscuela;
use App\Models\Usuario;
// use App\Models\Persona;

use Illuminate\Database\Seeder;

class Usuario_EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   /* lo deshabilito porque no coincide con los modelos
       /* $ue = new Usuario_Escuela();

        // $persona = Persona::where('documento_numero', 32126643)
        //                    ->where('id_documento_tipo', 1)
        //                    ->get();

        $usuario = User::where('nombre_usuario', "alex")
                           ->get();

        $existe_ue = $ue::count();

      //   Sí existe el usuario, y no hay ningún registro en Usuario_Escuela

         if (count($usuario)>0 and !$existe_ue) {

            $ue->id_escuela = 10109;
            $ue->id_usuario = $usuario[0]->id;
            $ue->es_admin = true;
            $ue->verificado = true;
            $ue->save();
         }*/
    }
}

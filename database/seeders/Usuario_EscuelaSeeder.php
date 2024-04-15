<?php

namespace Database\Seeders;

use App\Models\Usuario_Escuela;
use App\Models\Usuario;
use App\Models\Persona;

use Illuminate\Database\Seeder;

class Usuario_EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ue = new Usuario_Escuela();

        $persona = Persona::where('documento_numero', 32126643)
                           ->where('id_documento_tipo', 1)
                           ->get();

        $usuario = Usuario::where('id_persona', 1)
                           ->get();

        $existe_ue = $ue::count();


      //   Sí existe la persona, y no hay ningún registro en Usuario_Escuela

         if (count($persona)>0 and !$existe_ue) {

            $ue->id_escuela = 10109;
            $ue->id_usuario = $usuario[0]->id;

            $ue->save();
         }
    }
}

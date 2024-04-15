<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usuario = new Usuario();

       // $persona = new Persona();
 
    //    $persona = new Persona();

        $persona = Persona::where('documento_numero', 32126643)
                          ->where('id_documento_tipo', 1)
                          ->get();

        $existe = $usuario::where('id_persona', 1)
                          ->count();
                     
     //   if (!empty($persona[0])) {
        if (count($persona)>0 and !$existe) {  
            $nombre = explode(" ", $persona[0]->nombre);       
            $usuario->id_persona = $persona[0]->id;
            $usuario->nombre = strtolower($nombre[0]);
            $usuario->es_admin = true;
            $usuario->clave = '1234';
            $usuario->orden = 10;

            $usuario->save();
        }

        //
    }
}

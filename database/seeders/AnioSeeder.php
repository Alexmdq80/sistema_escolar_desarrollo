<?php

namespace Database\Seeders;

use App\Models\Anio;
use Illuminate\Database\Seeder;

class AnioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      //  $registros = DB::select('select * from anio;');
        $registros = Anio::count();
     
        if (!$registros) {
            for ($x = 1; $x <= 7 ; $x++) {
                    // echo " **** $x ****";
                if ($x <= 3) {
                  $id_ciclo_plan_estudio = 1;
                  $anio_relativo = $x;
                  $anio_abs = $x;
                  $nombre = $x;
                } elseif ($x < 7) {
                  $id_ciclo_plan_estudio = 2;
                  $anio_relativo = $x - 3;
                  $anio_abs = $x;
                  $nombre = $x;
                } else {
                  $id_ciclo_plan_estudio = 1;
                  $anio_relativo = 1;
                  $anio_abs = 1;
                  $nombre = "A.F.";                   
                }

                switch($x){
                    case 1:
                        $nombre_completo ="PRIMERO";
                        break;
                    case 2:
                        $nombre_completo ="SEGUNDO";
                        break;
                    case 3:
                        $nombre_completo ="TERCERO";
                        break;
                    case 4:
                        $nombre_completo ="CUARTO";
                        break;
                    case 5:
                        $nombre_completo ="QUINTO";
                        break;
                    case 6:
                        $nombre_completo ="SEXTO";
                        break;
                    case 7:
                        $nombre_completo ="AULA DE FORTALECIMIENTO";
                        break;
                    default:
                        $nombre_completo = "???";
                        break;
                }

                $anio = new Anio();
                $anio->id_ciclo_plan_estudio = $id_ciclo_plan_estudio;
                $anio->nombre = $nombre;
                $anio->nombre_completo = $nombre_completo;
                $anio->anio_absoluto = $anio_abs;
                $anio->anio_relativo = $anio_relativo;
                $anio->orden = $x;
                $anio->save();
            }
        }
    }

}

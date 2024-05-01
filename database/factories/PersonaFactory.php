<?php

namespace Database\Factories;

use App\Models\Persona;
// use App\Models\Documento_Tipo;
// use App\Models\Documento_Situacion;
// use App\Models\Sexo;
use App\Models\Genero;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Localidad_Asentamiento;
use Database\Seeders\PersonaSeeder;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{

    protected $model = Persona::Class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        // VACÍO LOS ARRAY
        // unset($nacionalidad_id_pais);
        // unset($nacimiento_lugar_id_pais);
        // unset($nacimiento_lugar_id_provincia);
        // unset($nacimiento_lugar_id_departamento);
        // unset($nacimiento_lugar_id_localidad);
        // *9*********************

        $total_personas = PersonaSeeder::get_n_personas();
        $p_transGenero = PersonaSeeder::get_n_transGenero();
        $p_noBinarios = PersonaSeeder::get_n_noBinarios();
        // echo "TOTAL PERSONAS $total_personas --NO BINARIOS $p_noBinarios -- ";
        // CALCULO EL PORCENTAJE DE NO BINARIOS
        $porc_noBinarios = $p_noBinarios * 100 / $total_personas;
        $porc_transGenero = $p_transGenero * 100 / $total_personas;

        $nombre_alternativo = NULL;
        // ****SEXO************
        // $sexos = Sexo::get(['id']);

        if ($porc_noBinarios > 4) {
        //  Si hay más de 4 cada 100, entonces ingreso un Masculino o un Femenino
          $id_sexo = $this->faker->randomElement([1,2]);
        } else {
          $id_sexo = 3;
          PersonaSeeder::set_n_noBinarios($p_noBinarios + 1);
        }
        // ********GÉNERO***********
        // $generos = Genero::get(['id']);
        $generos = PersonaSeeder::get_id_generos();
        $id_genero = new Genero;
        if  ($porc_transGenero > 4) {
        // Si hay más de 4 cada 100 transgénero, entonces ingreso uno que coincida el género con el sexo
          if ($id_sexo == 1) {
            $nombre = mb_strtoupper($this->faker->name($gender = 'male'));
            $id_genero->id = 2;
            // $id_genero = (object) ['id' => 2];
          } elseif ($id_sexo == 2) {
            $nombre = mb_strtoupper($this->faker->name($gender = 'female'));
            $apellido = mb_strtoupper($this->faker->lastname());
            $id_genero->id = 1;
            // $id_genero = (object) ['id' => 1];
          } else {
            $nombre = mb_strtoupper($this->faker->name());
            $id_genero->id = 3;
            // $id_genero = (object) ['id' => 3];
          }
        } else {
            $nombre_alternativo = mb_strtoupper($this->faker->name());
            if ($id_sexo == 1) {
                $nombre = mb_strtoupper($this->faker->name($gender = 'male'));
                // $id_genero = $this->faker->randomElement([1,3,4,6,7]);
                $id_genero->id = $this->faker->randomElement([1,3,4,6,7]);
                // $id_genero = (object) ['id' => $n];
                PersonaSeeder::set_n_transGenero($p_transGenero + 1);
            } elseif ($id_sexo == 2) {
                $nombre = mb_strtoupper($this->faker->name($gender = 'female'));
                // $id_genero = $this->faker->randomElement([2,3,5,6,7]);
                $id_genero->id = $this->faker->randomElement([2,3,5,6,7]);
                // $id_genero = (object) ['id' => $n];
                PersonaSeeder::set_n_transGenero($p_transGenero + 1);
            } else {
                $nombre = mb_strtoupper($this->faker->name());
                $id_genero->id = 3;
                // $id_genero = (object) ['id' => 3];
            }
        }
        // print_r($id_genero);
        // print_r($generos);
        $apellido = mb_strtoupper($this->faker->lastname());

        // $documento_situaciones = Documento_Situacion::get(['id']);
        // $documento_situaciones = PersonaSeeder::get_documento_situaciones();
        // $documento_tipos = PersonaSeeder::get_documento_tipos();

        $paises = PersonaSeeder::get_id_paises();
        // print_r($paises);
        $p_conCPI = PersonaSeeder::get_n_conCPI();
        $p_fallecidos = PersonaSeeder::get_n_fallecidos();
        $p_argNacidosExterior = PersonaSeeder::get_n_argNacidosExterior();
        $p_noArgentinos = PersonaSeeder::get_n_noArgentinos();

        $porc_noArgentinos = $p_noArgentinos * 100 / $total_personas;
        $porc_argNacidosExterior = $p_argNacidosExterior * 100 / $total_personas;
        $porc_conCPI = $p_conCPI * 100 / $total_personas;
        $porc_fallecidos = $p_fallecidos * 100 / $total_personas;

        if ($porc_fallecidos > 2){
            // Si el más del 2% está fallecido, entonces agrego uno vivo
          $vive_si = -1;
        } else {
          $vive_si = 0;
          PersonaSeeder::set_n_fallecidos($p_fallecidos + 1);
        }
        $p_menores = PersonaSeeder::get_n_menores();
        $porc_menores = $p_menores * 100 / $total_personas;
        if ($porc_menores > 50){
          // SI HAY MÁS DEL 75% DE MENORES, ENTONCES AGREGO UN ADULTO
          $nacimiento_fecha = $this->faker->dateTimeBetween($startDate = '-100 years', $endDate = '2004-01-01', $timezone = null);
        } else {
          $nacimiento_fecha = $this->faker->dateTimeBetween($startDate = '-20 years', $endDate = '2012-01-01', $timezone = null);
        }
        $edad = Carbon::parse($nacimiento_fecha)->age;
    
        if ($edad < 20) {
           PersonaSeeder::set_n_menores($p_menores + 1);
        }

        // ***********PARA CREAR CON UNA EDAD DETERMINADA***********
        $nacimiento_fecha = '2013-05-07';

        $nacimiento_lugar_id_pais = new Pais;
        $nacionalidad_id_pais = new Pais;


        if ($porc_noArgentinos > 4) {
        // Si hay más de 4 cada 100 extranjeros entonces ingreso un argentino
        //   $nacionalidad_id_pais = (object) ['id' => 158];
          $nacionalidad_id_pais->id = 158;
          $id_documento_situacion = $this->faker->randomElement([1,2,3,5]);
          $id_documento_tipo = 1;
          $CUIL_prefijo = $this->faker->randomElement([20,23,24,27]);
          $CUIL_sufijo =  $this->faker->randomElement([0,1,2,3,4,5,6,7,8,9]);
          $tramite = $this->faker->numberBetween($min = 10000000000, $max = 99999999999);
          $posee_cpi_si = 0;
          $posee_docExt_si = 0;
          if ($edad < 20) {
            $documento_numero = $this->faker->numberBetween($min = 40000000, $max = 60000000);
          } else {
            $documento_numero = $this->faker->numberBetween($min = 7000000, $max = 35000000);
          }
          if ($porc_argNacidosExterior > 4 ) {
            // Si hay más de 4 cada 100 de argentinos nacidos en el exterior entonces
            // ingreso un nacido en Argentina
            $nacimiento_lugar_id_pais->id = 158;
            // $nacimiento_lugar_id_pais = (object) ['id' => 158];
          } else {
            $nacimiento_lugar_id_pais = $this->faker->randomElement($paises);

          }

        } else {
          $nacimiento_lugar_id_pais = $this->faker->randomElement($paises);
          $nacionalidad_id_pais = $nacimiento_lugar_id_pais;
          $CUIL_prefijo = NULL;
          $CUIL_sufijo = NULL;
          $tramite = NULL;
          $id_documento_situacion = 4;
          // NO POSEE DOCUMENTO ARGENTINO
          if ($porc_conCPI > 1){
          // SI HAY MÁS DE 4% CON CPI ENTONCES LE ASIGNO UN DOCUMENTO EXTRANJERO
            $id_documento_tipo = $this->faker->randomElement([2,4,5]);
            $posee_cpi_si = 0;
            $posee_docExt_si = -1;
            $documento_numero = $this->faker->numberBetween($min = 9000000, $max = 99000000);
          } else {
            PersonaSeeder::set_n_conCPI($p_conCPI + 1);
            $id_documento_tipo = 5;
            $posee_cpi_si = -1;
            $posee_docExt_si = 0;
            $documento_numero = NULL;
          }

        }
        // $nacimiento_lugar_id_provincia = new Provincia;
        if ($nacimiento_lugar_id_pais->id == 158) {
        //   $provincias = Provincia::where('id_pais', 158)->get(['id'])->pluck('id');
          $provincias = Provincia::where('id_pais', 158)->get(['id']);
          $nacimiento_lugar_id_provincia = $this->faker->randomElement($provincias);

        //   $departamentos = Departamento::where('id_provincia', $nacimiento_lugar_id_provincia)->get(['id'])->pluck('id');
          $departamentos = Departamento::where('id_provincia', $nacimiento_lugar_id_provincia->id)->get(['id']);
          if ($departamentos == NULL) {
            $nacimiento_lugar_id_departamento = new Departamento;
            $nacimiento_lugar_id_departamento->id = NULL;
          } else {
            $nacimiento_lugar_id_departamento = $this->faker->randomElement($departamentos);
          }
        //   $localidades = Localidad_Asentamiento::where('id_departamento', $nacimiento_lugar_id_departamento)->get(['id'])->pluck('id');
          $localidades = Localidad_Asentamiento::where('id_departamento', $nacimiento_lugar_id_departamento->id)->get(['id']);
          if ($localidades == NULL) {
            $nacimiento_lugar_id_localidad = new Localidad_Asentamiento;
            $nacimiento_lugar_id_localidad->id = NULL;
            // $nacimiento_lugar_id_localidad = (object) ['id' => NULL];
          } else {
            $nacimiento_lugar_id_localidad = $this->faker->randomElement($localidades);
          }

        } else {
          $nacimiento_lugar_id_provincia = new Provincia;
          $nacimiento_lugar_id_provincia->id = NULL;
          $nacimiento_lugar_id_departamento = new Departamento;
          $nacimiento_lugar_id_departamento->id = NULL;
          $nacimiento_lugar_id_localidad = new Localidad_Asentamiento;
          $nacimiento_lugar_id_localidad->id = NULL;
          if ($nacionalidad_id_pais->id == 158) {
            PersonaSeeder::set_n_argNacidosExterior($p_argNacidosExterior + 1);
          }
          PersonaSeeder::set_n_noArgentinos($p_noArgentinos + 1);
        }
        // if ($nacimiento_lugar_id_localidad == NULL) {
        //     echo "LOCALIDAD NULO";
        //     var_dump($nacimiento_lugar_id_localidad);
        // }
        // print_r("Localidad: " . $nacimiento_lugar_id_localidad);
        // var_dump($nacimiento_lugar_id_localidad);
        PersonaSeeder::set_n_personas($total_personas + 1);


        // PersonaSeeder::set_n_sinDNI(); NO LO USO POR AHORA???

        // PersonaSeeder::set_n_sinDNIsinDocExt(); NO LO USO POR AHORA???



        // echo "nombre: $nombre"."\n";
        // echo "apellido: $apellido"."\n";
        // echo "documento_tipo: $doc_tipo->id"."\n";
        // echo "documento_situacion: $doc_situacion->id"."\n";
        // echo "sexo: $sexo->id"."\n";
        // echo "genero: $genero->id"."\n";

        // echo "Persona: ";
        // print_r(PersonaSeeder::getAux());
        if (is_null($nacionalidad_id_pais)){
            $nacionalidad = NULL;
        } else {
            $nacionalidad = $nacionalidad_id_pais->id;
        }
        if (is_null($nacimiento_lugar_id_pais)){
            $pais = NULL;
        } else {
            $pais = $nacimiento_lugar_id_pais->id;
        }
        if (is_null($nacimiento_lugar_id_provincia)){
            $provincia = NULL;
        } else {
            $provincia = $nacimiento_lugar_id_provincia->id;
        }
        if (is_null($nacimiento_lugar_id_departamento)){
            $departamento = NULL;
        } else {
            $departamento = $nacimiento_lugar_id_departamento->id;
        }
        if (is_null($nacimiento_lugar_id_localidad)){
            $localidad = NULL;
        } else {
            $localidad = $nacimiento_lugar_id_localidad->id;
        }

        return [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'nombre_alternativo' => $nombre_alternativo,
            'id_documento_tipo' => $id_documento_tipo,
            'id_documento_situacion' => $id_documento_situacion,
            'id_sexo' => $id_sexo,
            'id_genero' => $id_genero->id,
            'nacionalidad_id_pais' => $nacionalidad ,
            'nacimiento_lugar_id_pais' => $pais,
            'nacimiento_lugar_id_provincia' => $provincia,
            'nacimiento_lugar_id_departamento' => $departamento,
            'nacimiento_lugar_id_localidad_asentamiento' => $localidad,
            'documento_numero' => $documento_numero,
            'tramite'=> $tramite,
            'posee_cpi_si' => $posee_cpi_si,
            'posee_docExt_si' => $posee_docExt_si,
            'vive_si' => $vive_si,
            'CUIL_prefijo' => $CUIL_prefijo,
            'CUIL_sufijo' => $CUIL_sufijo,
            'nacimiento_fecha' => $nacimiento_fecha
        ];
    }
}

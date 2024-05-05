<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\Persona;
use App\Models\Escuela;
use Carbon\Carbon;
use App\Models\Condicion;
use App\Models\Espacio_Academico;
use App\Models\Anio;
use App\Models\Nivel;

class InscripcionSeeder extends Seeder
{
    protected static int $id_persona;
    protected static int $id_espacio_academico;
    protected static int $id_condicion;
    protected static int $id_nivel_procedencia;
    protected static $id_escuelas;
    // protected static int $edad;

    public static function set_id_escuelas($valor): void
    {
        self::$id_escuelas = $valor;
    }
    public static function get_id_escuelas()
    {
        return self::$id_escuelas;
    }

    public static function set_id_persona(int $valor): void
    {
        self::$id_persona = $valor;
    }
    public static function get_id_persona(): int
    {
        return self::$id_persona;
    }
    public static function set_id_espacio_academico(int $valor): void
    {
        self::$id_espacio_academico = $valor;
    }
    public static function get_id_espacio_academico(): int
    {
        return self::$id_espacio_academico;
    }
    public static function set_id_condicion(int $valor): void
    {
        self::$id_condicion = $valor;
    }
    public static function get_id_condicion(): int
    {
        return self::$id_condicion;
    }
    public static function set_id_nivel_procedencia(int $valor): void
    {
        self::$id_nivel_procedencia = $valor;
    }
    public static function get_id_nivel_procedencia(): int
    {
        return self::$id_nivel_procedencia;
    }
    // public static function set_edad(int $valor): void
    // {
    //     self::$edad = $valor;
    // }
    // public static function get_edad(): int
    // {
    //     return self::$edad;
    // }

    public function run(): void
    {
        $registros = Inscripcion::count();
        
        if (!$registros) {
            
            // $espacios_academicos = Espacio_Academico::get();

         
            $id_condiciones = Condicion::get(['id']);

            $fecha_reciente = Carbon::now()->subYears( 9);
            $fecha_antigua = Carbon::now()->subYears(21);
          
            // $fecha_date_actual= Carbon::parse($fecha_actual);
            // $fecha_reciente = $fecha_date_actual->subYears(11);
            // $fecha_antigua = $fecha_date_actual->subYears(20);
            // $fecha_date_reciente = Carbon::parse($fecha_reciente);
            // $fecha_date_antigua = Carbon::parse($fecha_antigua);
            // $fecha_date_reciente = $fecha_reciente->format('Y-m-d');
            // $fecha_date_antigua = $fecha_antigua->format('Y-m-d');
            // echo "$fecha_date_reciente \n";
            // echo "$fecha_date_antigua \n";
            echo "$fecha_reciente \n";
            echo "$fecha_antigua \n";
            $personas = Persona::where([
                ['nacimiento_fecha','>',$fecha_antigua],
                ['nacimiento_fecha','<',$fecha_reciente],
                ])->orderBy('nacimiento_fecha','desc')->get(); 
// CARGO PRIMERO LAS ESCUELAS PRIMARIAS...  
            $primarias = true;
            $nivel = Nivel::find(2);
            $escuelas = $nivel->escuelas;
            self::set_id_escuelas($escuelas->pluck('id'));

        // SETEO DE FORMA ALEATORIA LA CANTIDAD DE ESTUDIANTES INGRESANTES O PROMOVIDOS
        // POR DIVISIÓN SEǴUN EL AÑO, EN EL CASO DE LOS 1EROS, SON INGRESANTES
            $e_1 = [rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20)];
            $e_2 = [rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20)];
            $e_3 = [rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20)];
            $e_4 = [rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20)];
            $e_5 = [rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20)];
            $e_6 = [rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20),
                    rand(10, 20)];
// SETEO DE FORMA ALEATORIA LA CANTIDAD DE ESTUDIANTES REPITENTES POR DIVISIÓN SEGÚN EL AÑO
            $r_AF = [rand(1,6),
                     rand(1,6)];
            $r_1 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $r_2 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $r_3 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $r_4 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $r_5 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];           
            $pa_2 = [rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10)];
            $pa_3 = [rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10)];
            $pa_4 = [rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10)];
            $pa_5 = [rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10)];
            $pa_6 = [rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10),
                    rand(1,10)];
// SETEO DE FORMA ALEATORIA LA CANTIDAD DE ESTUDIANTES REINSCRIPTOS POR DIVISIÓN SEGÚN EL AÑO            
            $ri_AF = [rand(1,6),
                      rand(1,6)];
            $ri_1 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $ri_2 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $ri_3 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $ri_4 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $ri_5 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)];
            $ri_6 = [rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6),
                    rand(1,6)]; 
            // CURSOS CARGADOS - CADA ELEMENTO DEL ARRAY ES UNA DIVISIÓN DEL  
            // AÑO QUE INDICA EL NOMBRE DE LA VARIABLE.
            $c_1 = [false,false,false,false];
            $c_2 = [false,false,false,false];
            $c_3 = [false,false,false,false];
            $c_4 = [false,false,false,false,false,false,false];
            $c_5 = [false,false,false,false,false,false,false];
            $c_6 = [false,false,false,false,false,false,false];
            
            $ca_2 = [false,false,false,false];
            $ca_3 = [false,false,false,false];
            $ca_4 = [false,false,false,false,false,false,false];
            $ca_5 = [false,false,false,false,false,false,false];
            $ca_6 = [false,false,false,false,false,false,false];

            $cri_1 = [false,false,false,false];
            $cri_2 = [false,false,false,false];
            $cri_3 = [false,false,false,false];
            $cri_4 = [false,false,false,false,false,false,false];
            $cri_5 = [false,false,false,false,false,false,false];
            $cri_6 = [false,false,false,false,false,false,false];
            $cri_AF = [false,false];

            $crep_1 = [false,false,false,false];
            $crep_2 = [false,false,false,false];
            $crep_3 = [false,false,false,false];
            $crep_4 = [false,false,false,false,false,false,false];
            $crep_5 = [false,false,false,false,false,false,false];
            $crep_AF = [false,false];

            $full_1 = false;
            $full_2 = false;
            $full_3 = false;
            $full_4 = false;
            $full_5 = false;
            $full_6 = false;
            $full_AF = false;

            $full_c_1 = false;
            $full_c_2 = false;
            $full_c_3 = false;
            $full_c_4 = false;
            $full_c_5 = false;
            $full_c_6 = false;

            $full_ca_2 = false;
            $full_ca_3 = false;
            $full_ca_4 = false;
            $full_ca_5 = false;
            $full_ca_6 = false;

            $full_ri_1 = false;
            $full_ri_2 = false;
            $full_ri_3 = false;
            $full_ri_4 = false;
            $full_ri_5 = false;
            $full_ri_6 = false;
            $full_ri_AF = false;

            $full_rep_1 = false;
            $full_rep_2 = false;
            $full_rep_3 = false;
            $full_rep_4 = false;
            $full_rep_5 = false;
            $full_rep_AF = false;

            foreach ($personas as $persona) {
                // echo "Persona ID: $persona->id \n";
                $fecha_nacimiento = Carbon::parse($persona->nacimiento_fecha);
                $edad = Carbon::parse($persona->nacimiento_fecha)->age;
                self::set_id_persona($persona->id);
                $crea = false;
                switch($edad){
                    case ($edad >= 11 && $edad <= 12):
// 1ER AÑO              
                        if ($edad == 11){   
                            $condicion = rand(1,3);
                            if ($condicion == 2){
                                $condicion = 1;
                            }                                  
                            self::set_id_condicion($condicion);
                            if ($condicion == 1){
                              self::set_id_nivel_procedencia(2);
                            } else {
                              self::set_id_nivel_procedencia(3);
                            }
                        } else {
                            $condicion = 4;
                            self::set_id_condicion($condicion);
                            self::set_id_nivel_procedencia(3);
                        }
                        $divisiones = Espacio_Academico::where('id_anio', 1)->get();
                        echo "Edad: $edad \n";
                        echo "Condicion: $condicion \n";
                        foreach ($divisiones as $division){
                            $n = $division->division - 1;
                            $id = $division->id;
                            echo "Edad: $edad \n";
                            echo "Año: 1º Division: $division->division Arreglo: $n \n";
                            echo "Ingresantes a cargar: $e_1[$n]; \n";     
                            echo "Reinscriptos a cargar: $ri_1[$n]; \n";     
                            echo "Repitentes a cargar: $r_1[$n]; \n";
                            $e_cargar = $e_1[$n];
                            $e_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 1])->count();
                            echo "Ingresantes cargados en $id: $e_cargados \n";
                            $ri_cargar = $ri_1[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 3])->count();
                            echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $r_cargar = $r_1[$n];
                            $r_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 4])->count();
                            echo "Repitentes cargados en $id: $r_cargados \n";

                            if ($edad == 11){
                            // SI TIENE 11 AÑOS, PUEDE SER INGRESANTE O REINSCRIPTO 
                              
                              switch ($condicion) {
                                case 1:
                                    $cargados = $e_cargados;
                                    $a_cargar = $e_cargar;  
                                    break;
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                              }
                            } else {
                              $cargados = $r_cargados;
                              $a_cargar = $r_cargar;
                            } 

                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias && $edad == 12) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } elseif (!$primarias && $edad == 11 && $condicion == 1) { 
                                    $primarias = true;
                                    $nivel = Nivel::find(2);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));     
                                }
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 1:
                                        $c_1[$n] = true;   
                                        if ($c_1[0] && $c_1[1] && $c_1[2] && $c_1[3]){
                                            $full_c_1 = true;
                                        }
                                    case 3:
                                        $cri_1[$n] = true;   
                                        if ($cri_1[0] && $cri_1[1] && $cri_1[2] && $cri_1[3]){
                                            $full_ri_1 = true;
                                        }
                                    case 4:
                                        $crep_1[$n] = true;   
                                        if ($crep_1[0] && $crep_1[1] && $crep_1[2] && $crep_1[3]){
                                            $full_rep_1 = true;
                                        }
                                 
                                }
                                if($full_c_1 && $full_ri_1 && $full_rep_1){
                                    $full_1 = true;
                                }
                                                 
                            } 
                        }                           
                        // if (!$c_1[0] || !$c_1[1] || !$c_1[2] || !$c_1[3]){ 
                        //   break;
                        // }
                        if ($crea){
                            break;
                        }
                    case ($edad == 12 || $edad == 13):
// 2DOS AÑO
                        $condicion = rand(2,5);
                        self::set_id_condicion($condicion);
                        self::set_id_nivel_procedencia(3);
                        $divisiones = Espacio_Academico::where('id_anio', 2)->get();
                        foreach ($divisiones as $division){
                            $n = $division->division - 1;
                            $id = $division->id;
                            // echo "Edad: $edad \n";
                            // echo "Año: 2º Division: $division->division Arreglo: $n \n";
                            // echo "Promovidos a cargar: $e_2[$n]; \n";                       
                            // echo "Reinscriptos a cargar: $ri_2[$n]; \n";
                            // echo "Repitentes a cargar: $r_2[$n]; \n";
                            // echo "Promovidos con materias pendientes a cargar: $pa_2[$n]; \n";    
                            $e_cargar = $e_2[$n];
                            $e_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 2])->count();
                            // echo "Promovidos cargados en $id: $e_cargados \n";
                            $ri_cargar = $ri_2[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 3])->count();
                            // echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $r_cargar = $r_2[$n];
                            $r_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 4])->count();
                            // echo "Repitentes cargados en $id: $r_cargados \n";
                            $pa_cargar = $pa_2[$n];
                            $pa_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 5])->count();
                            // echo "Promovidos con materias pendientes cargados en $id: $pa_cargados \n";
                            
                            switch ($condicion) {
                                case 2:
                                    $cargados = $e_cargados;
                                    $a_cargar = $e_cargar;  
                                    break;
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                                case 4:
                                    $cargados = $r_cargados;
                                    $a_cargar = $r_cargar;
                                    break;
                                case 5:
                                    $cargados = $pa_cargados;
                                    $a_cargar = $pa_cargar;  
                                    break;
                            }

                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } 
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 2:
                                        $c_2[$n] = true;   
                                        if ($c_2[0] && $c_2[1] && $c_2[2] && $c_2[3]){
                                            $full_c_2 = true;
                                        }
                                    case 3:
                                        $cri_2[$n] = true;   
                                        if ($cri_2[0] && $cri_2[1] && $cri_2[2] && $cri_2[3]){
                                            $full_ri_2= true;
                                        }
                                    case 4:
                                        $crep_2[$n] = true;   
                                        if ($crep_2[0] && $crep_2[1] && $crep_2[2] && $crep_2[3]){
                                            $full_rep_2 = true;
                                        }
                                    case 5:
                                        $ca_2[$n] = true;   
                                        if ($ca_2[0] && $ca_2[1] && $ca_2[2] && $ca_2[3]){
                                            $full_ca_2 = true;
                                        }                                 
                                }
                                if($full_c_2 && $full_ri_2 && $full_rep_2 && $full_ca_2){
                                    $full_2 = true;
                                }                       
                            } 
                        }                           
                        // if (!$c_2[0] || !$c_2[1] || !$c_2[2] || !$c_2[3]){ 
                        //   break;
                        // }
                        if ($crea){
                            break;
                        }

                    case ($edad == 13 || $edad == 14):
// 3ER AÑO
                        $condicion = rand(2,5);
                        self::set_id_condicion($condicion);
                        self::set_id_nivel_procedencia(3);
                       
                        $divisiones = Espacio_Academico::where('id_anio', 3)->get();
                        foreach ($divisiones as $division){
                            if ($division->division == 5){
                              $n = 1;
                            } else {
                              $n = $division->division - 1;
                            }
                            $id = $division->id;
                            // echo "Edad: $edad \n";
                            // echo "Año: 3º Division: $division->division Arreglo: $n \n";
                            // echo "Promovidos a cargar: $e_3[$n]; \n";                       
                            // echo "Reinscriptos a cargar: $ri_3[$n]; \n";
                            // echo "Repitentes a cargar: $r_3[$n]; \n";
                            // echo "Promovidos con materias pendientes a cargar: $pa_3[$n]; \n";    
                            $e_cargar = $e_3[$n];
                            $e_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 2])->count();
                            // echo "Promovidos cargados en $id: $e_cargados \n";
                            $ri_cargar = $ri_3[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 3])->count();
                            // echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $r_cargar = $r_3[$n];
                            $r_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 4])->count();
                            // echo "Repitentes cargados en $id: $r_cargados \n";
                            $pa_cargar = $pa_3[$n];
                            $pa_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 5])->count();
                            // echo "Promovidos con materias pendientes cargados en $id: $pa_cargados \n";
                            
                            switch ($condicion) {
                                case 2:
                                    $cargados = $e_cargados;
                                    $a_cargar = $e_cargar;  
                                    break;
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                                case 4:
                                    $cargados = $r_cargados;
                                    $a_cargar = $r_cargar;
                                    break;
                                case 5:
                                    $cargados = $pa_cargados;
                                    $a_cargar = $pa_cargar;  
                                    break;
                            }

                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } 
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 2:
                                        $c_3[$n] = true;   
                                        if ($c_3[0] && $c_3[1] && $c_3[2] && $c_3[3]){
                                            $full_c_3 = true;
                                        }
                                    case 3:
                                        $cri_3[$n] = true;   
                                        if ($cri_3[0] && $cri_3[1] && $cri_3[2] && $cri_3[3]){
                                            $full_ri_3= true;
                                        }
                                    case 4:
                                        $crep_3[$n] = true;   
                                        if ($crep_3[0] && $crep_3[1] && $crep_3[2] && $crep_3[3]){
                                            $full_rep_3 = true;
                                        }
                                    case 5:
                                        $ca_3[$n] = true;   
                                        if ($ca_3[0] && $ca_3[1] && $ca_3[2] && $ca_3[3]){
                                            $full_ca_3 = true;
                                        }                                 
                                }
                                if($full_c_3 && $full_ri_3 && $full_rep_3 && $full_ca_3){
                                    $full_3 = true;
                                }                      
                            } 
                        }                           
                        // if (!$c_3[0] || !$c_3[1] || !$c_3[2] || !$c_3[3]){ 
                        //     break;
                        // }          
                        if ($crea){
                            break;
                        }
                    case ($edad == 14 || $edad == 15):
// 4TO AÑO
                        $condicion = rand(2,5);
                        self::set_id_condicion($condicion);
                        self::set_id_nivel_procedencia(3);
                       
                        $divisiones = Espacio_Academico::where('id_anio', 4)->get();
                        foreach ($divisiones as $division){
                            if ($division->division == 8){
                              $n = 6;
                            } else {
                              $n = $division->division - 1;
                            }
                            $id = $division->id;
                            // echo "Edad: $edad \n";
                            // echo "Año: 4º Division: $division->division Arreglo: $n \n";
                            // echo "Promovidos a cargar: $e_4[$n]; \n";                       
                            // echo "Reinscriptos a cargar: $ri_4[$n]; \n";
                            // echo "Repitentes a cargar: $r_4[$n]; \n";
                            // echo "Promovidos con materias pendientes a cargar: $pa_4[$n]; \n";    
                            $e_cargar = $e_4[$n];
                            $e_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                            'id_condicion' => 2])->count();
                            // echo "Promovidos cargados en $id: $e_cargados \n";
                            $ri_cargar = $ri_4[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                            'id_condicion' => 3])->count();
                            // echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $r_cargar = $r_4[$n];
                            $r_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                            'id_condicion' => 4])->count();
                            // echo "Repitentes cargados en $id: $r_cargados \n";
                            $pa_cargar = $pa_4[$n];
                            $pa_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                            'id_condicion' => 5])->count();
                            // echo "Promovidos con materias pendientes cargados en $id: $pa_cargados \n";
                            
                            switch ($condicion) {
                                case 2:
                                    $cargados = $e_cargados;
                                    $a_cargar = $e_cargar;  
                                    break;
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                                case 4:
                                    $cargados = $r_cargados;
                                    $a_cargar = $r_cargar;
                                    break;
                                case 5:
                                    $cargados = $pa_cargados;
                                    $a_cargar = $pa_cargar;  
                                    break;
                            }

                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } 
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 2:
                                        $c_4[$n] = true;   
                                        if ($c_4[0] && $c_4[1] && $c_4[2] && $c_4[3] && 
                                            $c_4[4] && $c_4[5] && $c_4[6]){
                                            $full_c_4 = true;
                                        }
                                    case 3:
                                        $cri_4[$n] = true;   
                                        if ($cri_4[0] && $cri_4[1] && $cri_4[2] && $cri_4[3] &&
                                            $cri_4[4] && $cri_4[5] && $cri_4[6] ){
                                            $full_ri_4= true;
                                        }
                                    case 4:
                                        $crep_4[$n] = true;   
                                        if ($crep_4[0] && $crep_4[1] && $crep_4[2] && $crep_4[3] &&
                                            $crep_4[4] && $crep_4[5] && $crep_4[6]){
                                            $full_rep_4 = true;
                                        }
                                    case 5:
                                        $ca_4[$n] = true;   
                                        if ($ca_4[0] && $ca_4[1] && $ca_4[2] && $ca_4[3] &&
                                            $ca_4[4] && $ca_4[5] && $ca_4[6]){
                                            $full_ca_4 = true;
                                        }                                 
                                }
                                if($full_c_4 && $full_ri_4 && $full_rep_4 && $full_ca_4){
                                    $full_4 = true;
                                }                     
                                               
                            } 
                        }                           
                        // if (!$c_4[0] || !$c_4[1] || !$c_4[2] || !$c_4[3]
                        //     || !$c_4[4] || !$c_4[5] || !$c_4[6]){ 
                        //     break;
                        // }
                        if ($crea){
                            break;
                        }
                    case ($edad == 15 || $edad == 16):
// 5TO AÑO
                        $condicion = rand(2,5);
                        self::set_id_condicion($condicion);
                        self::set_id_nivel_procedencia(3);
                   
                        $divisiones = Espacio_Academico::where('id_anio', 5)->get();
                        foreach ($divisiones as $division){
                            if ($division->division == 8){
                                $n = 6;
                            } else {
                                $n = $division->division - 1;
                            }
                            $id = $division->id;
                            // echo "Edad: $edad \n";
                            // echo "Año: 5º Division: $division->division Arreglo: $n \n";
                            // echo "Promovidos a cargar: $e_5[$n]; \n";                       
                            // echo "Reinscriptos a cargar: $ri_5[$n]; \n";
                            // echo "Repitentes a cargar: $r_5[$n]; \n";
                            // echo "Promovidos con materias pendientes a cargar: $pa_5[$n]; \n";    
                            $e_cargar = $e_5[$n];
                            $e_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 2])->count();
                            // echo "Promovidos cargados en $id: $e_cargados \n";
                            $ri_cargar = $ri_5[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 3])->count();
                            // echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $r_cargar = $r_5[$n];
                            $r_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 4])->count();
                            // echo "Repitentes cargados en $id: $r_cargados \n";
                            $pa_cargar = $pa_5[$n];
                            $pa_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 5])->count();
                            // echo "Promovidos con materias pendientes cargados en $id: $pa_cargados \n";
                            
                            switch ($condicion) {
                                case 2:
                                    $cargados = $e_cargados;
                                    $a_cargar = $e_cargar;  
                                    break;
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                                case 4:
                                    $cargados = $r_cargados;
                                    $a_cargar = $r_cargar;
                                    break;
                                case 5:
                                    $cargados = $pa_cargados;
                                    $a_cargar = $pa_cargar;  
                                    break;
                            }
                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } 
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 2:
                                        $c_5[$n] = true;   
                                        if ($c_5[0] && $c_5[1] && $c_5[2] && $c_5[3] && 
                                            $c_5[4] && $c_5[5] && $c_5[6]){
                                            $full_c_5 = true;
                                        }
                                    case 3:
                                        $cri_5[$n] = true;   
                                        if ($cri_5[0] && $cri_5[1] && $cri_5[2] && $cri_5[3] &&
                                            $cri_5[4] && $cri_5[5] && $cri_5[6] ){
                                            $full_ri_5= true;
                                        }
                                    case 4:
                                        $crep_5[$n] = true;   
                                        if ($crep_5[0] && $crep_5[1] && $crep_5[2] && $crep_5[3] &&
                                            $crep_5[4] && $crep_5[5] && $crep_5[6]){
                                            $full_rep_5 = true;
                                        }
                                    case 5:
                                        $ca_5[$n] = true;   
                                        if ($ca_5[0] && $ca_5[1] && $ca_5[2] && $ca_5[3] &&
                                            $ca_5[4] && $ca_5[5] && $ca_5[6]){
                                            $full_ca_5 = true;
                                        }                                 
                                }
                                if($full_c_5 && $full_ri_5 && $full_rep_5 && $full_ca_5){
                                    $full_5 = true;
                                }                         
                            } 
                        }                           
                        // if (!$c_5[0] || !$c_5[1] || !$c_5[2] || !$c_5[3]
                        //     || !$c_5[4] || !$c_5[5] || !$c_5[6]){ 
                        //     break;
                        // } 
                        if ($crea){
                            break;
                        }
                    case ($edad == 16 || $edad == 17):
// 6TO AÑO
                        $condicion = rand(2,5);
                        if ($condicion == 4){
                           $condicion = 2;
                        }                                  
                        self::set_id_condicion($condicion);
                        self::set_id_nivel_procedencia(3);
                             
                        $divisiones = Espacio_Academico::where('id_anio', 6)->get();
                        foreach ($divisiones as $division){
                            if ($division->division == 8){
                                $n = 6;
                            } else {
                                $n = $division->division - 1;
                            }
                            $id = $division->id;
                            // echo "Edad: $edad \n";
                            // echo "Año: 6º Division: $division->division Arreglo: $n \n";
                            // echo "Promovidos a cargar: $e_6[$n]; \n";                       
                            // echo "Reinscriptos a cargar: $ri_6[$n]; \n";
                            // echo "Promovidos con materias pendientes a cargar: $pa_6[$n]; \n";    
                            $e_cargar = $e_6[$n];
                            $e_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 2])->count();
                            // echo "Promovidos cargados en $id: $e_cargados \n";
                            $ri_cargar = $ri_6[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 3])->count();
                            // echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $pa_cargar = $pa_6[$n];
                            $pa_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 5])->count();
                            // echo "Promovidos con materias pendientes cargados en $id: $pa_cargados \n";
                            
                            switch ($condicion) {
                                case 2:
                                    $cargados = $e_cargados;
                                    $a_cargar = $e_cargar;  
                                    break;
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                                case 5:
                                    $cargados = $pa_cargados;
                                    $a_cargar = $pa_cargar;  
                                    break;
                            }

                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } 
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 2:
                                        $c_6[$n] = true;   
                                        if ($c_6[0] && $c_6[1] && $c_6[2] && $c_6[3] && 
                                            $c_6[4] && $c_6[5] && $c_6[6]){
                                            $full_c_6 = true;
                                        }
                                    case 3:
                                        $cri_6[$n] = true;   
                                        if ($cri_6[0] && $cri_6[1] && $cri_6[2] && $cri_6[3] &&
                                            $cri_6[4] && $cri_6[5] && $cri_6[6] ){
                                            $full_ri_6= true;
                                        }
                                    case 5:
                                        $ca_6[$n] = true;   
                                        if ($ca_6[0] && $ca_6[1] && $ca_6[2] && $ca_6[3] &&
                                            $ca_6[4] && $ca_6[5] && $ca_6[6]){
                                            $full_ca_6 = true;
                                        }                                 
                                }
                                if($full_c_6 && $full_ri_6 && $full_ca_6){
                                    $full_6 = true;
                                }                           
                            } 
                        }                           
                        // if (!$c_6[0] || !$c_6[1] || !$c_6[2] || !$c_6[3]
                        //     || !$c_6[4] || !$c_6[5] || !$c_6[6]){ 
                        //     break;
                        // }     
                        if ($crea){
                            break;
                        }          

                    case ($edad >= 17):
// A.F.
                        $condicion = rand(3,4);
                        self::set_id_condicion($condicion);
                        self::set_id_nivel_procedencia(3);
                      
                        $divisiones = Espacio_Academico::where('id_anio', 7)->get();
                        foreach ($divisiones as $division){
                            $n = $division->division - 1;
                            $id = $division->id;
                            // echo "Edad: $edad \n";
                            // echo "Año: A.F. Division: $division->division Arreglo: $n \n";
                            // echo "Reinscriptos a cargar: $ri_AF[$n]; \n";
                            // echo "Repitentes a cargar: $r_AF[$n]; \n";
                            $ri_cargar = $ri_AF[$n];
                            $ri_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                               'id_condicion' => 3])->count();
                            // echo "Reinscriptos cargados en $id: $ri_cargados \n";
                            $r_cargar = $r_AF[$n];
                            $r_cargados = Inscripcion::where(['id_espacio_academico' => $id,
                                                              'id_condicion' => 4])->count();
                            // echo "Repitentes cargados en $id: $r_cargados \n";
                            switch ($condicion) {
                                case 3:
                                    $cargados = $ri_cargados;
                                    $a_cargar = $ri_cargar;  
                                    break;
                                case 4:
                                    $cargados = $r_cargados;
                                    $a_cargar = $r_cargar;  
                                    break;
                            }
                            

                            if ($cargados < $a_cargar){
                                self::set_id_espacio_academico($id);
                                if ($primarias) {
                                    $primarias = false;
                                    $nivel = Nivel::find(3);
                                    $escuelas = $nivel->escuelas;
                                    self::set_id_escuelas($escuelas->pluck('id'));                    
                                } 
                                $crea = true;
                                break;       
                            } else {
                                switch ($condicion){
                                    case 3:
                                        $cri_AF[$n] = true;   
                                        if ($cri_AF[0] && $cri_AF[1]){
                                            $full_ri_AF= true;
                                        }
                                    case 4:
                                        $crep_AF[$n] = true;   
                                        if ($crep_AF[0] && $crep_AF[1]){
                                            $full_rep_AF = true;
                                        }                          
                                }
                                if($full_ri_AF && $full_rep_AF ){
                                    $full_AF = true;
                                }                      
                            } 
                        }                           
                        // if (!$c_AF[0] || !$c_AF[1]){ 
                        //     break;
                        // }          
                    break;

                }
                    
                if ($crea){
                  Inscripcion::factory(1)->create();
                  $crea = false;
                }

                if ($full_1 && $full_2 && $full_3 && $full_4 && $full_5 && $full_6 && $full_AF){
                    break;
                }
 
            } 
        }
    }
}

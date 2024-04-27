<?php

namespace Database\Seeders;

use App\Models\Espacio_Academico;
use App\Models\Anio;
use App\Models\Propuesta_Institucional;
use Illuminate\Database\Seeder;

class Espacio_AcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function guardar($pi, $anio, $division_n, $division_nombre):void {
        $ea = new Espacio_Academico();
        $ea->id_plan_estudio = $pi->id_plan_estudio;
        $ea->id_ciclo_plan_estudio = $pi->id_ciclo_plan_estudio;
        $ea->id_anio = $pi->id_anio;
        $ea->id_anio_plan = $pi->id_anio_plan;
        $ea->id_propuesta_institucional = $pi->id;
        $ea->id_seccion_tipo = 1;
        $ea->id_turno_inicio = $pi->id_turno_inicio;
        $ea->id_turno_fin = $pi->id_turno_fin;
        $ea->division = $division_n;
        $ea->division_nombre = $division_nombre;
        $ea->save();
    }

    public function run(): void
    {

        $registros = Espacio_Academico::count();

        $propuestas_institucionales = Propuesta_Institucional::get();
        $anios = new Anio();

        if (!$registros) {
            foreach ($propuestas_institucionales as $pi){
                $anio = new Anio();
                $anio = $anios->where('id', $pi->id_anio)->get();

                switch ($pi->id_plan_estudio) {
                    case 1:
                        // CICLO BÁSICO ************************************************
                        switch ($pi->id_turno_inicio) {
                           case 1:
                            // TURNO MAÑANA
                                if ($anio[0]->anio_absoluto == 1 or $anio[0]->anio_absoluto == 2) {
                                    // CICLO BÁSICO ************************************************
                                    //TURNO MAÑANA 1 1 y 1 2 / 2 1 Y 2 2
                                    //TURNO MAÑANA 1 1 y 1 2 / 2 1 Y 2 2
                                    $this->guardar($pi, $anio[0], "1", "PRIMERA");
                                    $this->guardar($pi, $anio[0], "2", "SEGUNDA");
                                }
                                if ($anio[0]->anio_absoluto == 3) {
                                    //TURNO MAÑANA 3 1 y 3 5
                                    $this->guardar($pi, $anio[0], "1", "PRIMERA");
                                    $this->guardar($pi, $anio[0], "5", "QUINTA");
                                }
                                break;
                            case 2:
                                // TURNO TARDE
                                //TURNO TARDE 1 3 y 1 4 / 2 3 Y 2 4 / 3 3 Y 3 4
                                $this->guardar($pi, $anio[0], "3", "TERCERA");
                                $this->guardar($pi, $anio[0], "4", "CUARTA");
                                break;
                        }
                        break;

                    case 2:
                        // CICLO BÁSICO A.F. ************************************************
                        //TURNO VESPERTINO AF 1 Y AF 2
                        $this->guardar($pi, $anio[0], "1", "PRIMERA");
                        $this->guardar($pi, $anio[0], "2", "SEGUNDA");
                        break;

                    case 3:
                        // CS.SOCIALES
                        switch ($pi->id_turno_inicio) {
                            case 1:
                                //TURNO MAÑANA 4 2 y 5 2 y 6 2
                                $this->guardar($pi, $anio[0], "2", "SEGUNDA");
                                break;
                            case 2:
                                // TURNO TARDE 4 4 y 5 4 y 6 4
                                $this->guardar($pi, $anio[0], "4", "CUARTA");
                                break;
                         }
                         break;

                    case 4:
                        // CS. NATURALES
                        switch ($pi->id_turno_inicio) {
                            case 1:
                                //TURNO MAÑANA 4 3 y 5 3 y 6 3
                                $this->guardar($pi, $anio[0], "3", "TERCERA");
                                break;
                            case 2:
                                // TURNO TARDE 4 6 y 5 6 y 6 6
                                $this->guardar($pi, $anio[0], "6", "SEXTA");
                                break;
                            }
                        break;
                    case 5:
                        // ECONOMÍA
                        switch ($pi->id_turno_inicio) {
                            case 1:
                                //TURNO MAÑANA 4 1 y 5 1 y 6 1
                                $this->guardar($pi, $anio[0], "1", "PRIMERA");
                                break;
                            case 2:
                                // TURNO TARDE 4 5 y 5 5 y 6 5
                                $this->guardar($pi, $anio[0], "5", "QUINTA");
                                break;
                            }
                        break;

                    case 6:
                        // TURISMO
                        // TURNO VESPERTINO 4 8 y 5 8 y 6 8
                        $this->guardar($pi, $anio[0], "8", "OCTAVA");
                        break;
                }
            }
        }
    }
}
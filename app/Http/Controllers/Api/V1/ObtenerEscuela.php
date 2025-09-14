<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Escuela;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ObtenerEscuela extends Controller
{
    //escuelaPorCue
     public function escuelaPorCue(string $cueAnexo)
    {
        /*$request->validate([
            'cueAnexo' => ['required']
        ]);*/

        // Busca la escuela y, si no la encuentra, lanza un 404
        //$escuela = Escuela::where('cue_anexo', $cueAnexo)->firstOrFail();
        /*$escuela = Escuela::select([
                'id', // ID de la escuela
                'nombre', // Nombre de la escuela
                'localidad_id',
                'departamento_id',
                'provincia_id',
                'nacion_id',
                'localidad.departamento.nombre',
                'localidad.departamento.provincia.nombre',
                'localidad.departamento.provincia.nacion.nombre',
            ])
            ->with([
                'localidad',
                'localidad.departamento',
                'localidad.departamento.provincia',
                'localidad.departamento.provincia.nacion',
        ])
        ->where('cue_anexo', $cueAnexo)
        ->firstOrFail();*/
        $escuela = Escuela::where('cue_anexo', $cueAnexo)
            ->select(['id', 'nombre', 'localidad_id']) // Solo las columnas que están en la tabla `escuelas`
            ->with('localidad.departamento.provincia.nacion')
            ->firstOrFail();

        logger()->info('Objeto Escuela encontrado:', ['escuela' => $escuela->toArray()]);

        return response()->json($escuela, 200);

        // Devuelve el objeto completo con las relaciones cargadas.

        //return response()->json($escuela, 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

// Importá todos tus modelos de referencia
use App\Models\DocumentoSituacion;
use App\Models\DocumentoTipo;
use App\Models\Sexo;
use App\Models\Genero;
use App\Models\Calle;
// use App\Models\OtroModeloReferencia;
// use App\Models\TercerModeloReferencia;

// Importá tus Resources si los usás (¡Recomendado!)
use App\Http\Resources\DocumentoSituacionResource;
use App\Http\Resources\DocumentoTipoResource;
use App\Http\Resources\SexoResource;
use App\Http\Resources\GeneroResource;
use App\Http\Resources\CalleResource;
//use App\Http\Resources\CalleResource;
// use App\Http\Resources\OtroModeloResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReferenceDataController extends Controller
{
    /**
     * Consolida todas las listas de referencia pequeñas en una sola respuesta.
     */
    // DEFINICIÓN DE TODAS LAS TABLAS DE REFERENCIA PARA VALIDACIÓN
    const ALL_REFERENCE_TABLES = [
        'documento_situacions' => \App\Models\DocumentoSituacion::class, 
        'documento_tipos'     => \App\Models\DocumentoTipo::class,
        'sexos'     => \App\Models\Sexo::class,
        'generos'     => \App\Models\Genero::class,
    ];
    public function index(Request $request)
    //: JsonResponse
    {
        $manifestoCliente = $request->json()->all();
        $responseData = [];
        $responseMetaData = [];
        // 1. Obtener la bandera de la BD
        // Asumiendo que obtienes el valor 'last_ref_update' de tu tabla de configuración
        //$serverPersonaLastUpdate = \DB::table('cache_control')->where('key', 'last_persona_ref_update')->value('value');
        $serverCacheControl = DB::table('cache_control')
            ->whereIn('key', array_keys(self::ALL_REFERENCE_TABLES))
            ->pluck('value', 'key')
            ->toArray();

        foreach (self::ALL_REFERENCE_TABLES as $claveVBA => $modelo) {

            $fechaCliente = data_get($manifestoCliente, $claveVBA); // Fecha que envió VBA
            $fechaServidor = data_get($serverCacheControl, $claveVBA); // Fecha de la BD de control
 // Si la bandera no existe en el servidor, forzamos la carga por si acaso
            $debeCargar = false;
            if (!$fechaServidor) {
                $debeCargar = true; 
            } elseif (!$fechaCliente || Carbon::parse($fechaCliente)->lt(Carbon::parse($fechaServidor))) {
                // Si el cliente no envió fecha, o su fecha es anterior
                $debeCargar = true;
            }
            if ($debeCargar) {
                // 2. Si debe cargar: Obtener datos, usar Resource y empaquetar
                $data = $modelo::all(); 

                // Determinar la clase Resource dinámicamente
                //$resourceClass = str_replace('Models', 'Resources', $modelo) . 'Resource';
                $resourceClass = str_replace('Models', 'Http\Resources', $modelo) . 'Resource'; 
                $responseData[$claveVBA] = $resourceClass::collection($data)->toArray($request);

                // Incluir el timestamp de la tabla para que VBA actualice el caché
                $responseMetaData[$claveVBA . '_ts'] = $fechaServidor; 

                //$documentosSituacion = DocumentoSituacion::where('vigente', true)->get();
                //$documentosSituacionColeccion = DocumentoSituacionResource::collection($documentosSituacion);

                //$documentosTipo = DocumentoTipo::where('vigente', true)->get();
                //$documentosTipoColeccion = DocumentoTipoResource::collection($documentosTipo);

                //$sexo = Sexo::where('vigente', true)->get();
                //$sexoColeccion = SexoResource::collection($sexo);
            }
        }
        //$calle = Calle::all();
        //$calleColeccion = CalleResource::collection($calle);

        /*$referenciasArray = [
            'documento_situacion' => DocumentoSituacionResource::collection($documentosSituacion)->toArray($request),
            'sexo' => SexoResource::collection($sexoColeccion)->toArray($request),
            'documento_tipo' => DocumentoTipoResource::collection($documentosTipoColeccion)->toArray($request),
            //'calle' => CalleResource::collection($calleColeccion)->toArray($request),
            // 'otra_lista' => OtroModeloResource::collection($otraLista)->toArray($request),
        ];*/


        $jsonResponse = json_encode([
            'metadata' => $responseMetaData,
            /*[
                'server_persona_last_update' => $serverPersonaLastUpdate
            ],*/
            //'data' => $referenciasArray
            'data' => $responseData
        ], JSON_UNESCAPED_UNICODE);

        // Retorna la respuesta ya serializada con el encabezado correcto
        return response($jsonResponse, 200)
            ->header('Content-Type', 'application/json; charset=utf-8');

    }
}

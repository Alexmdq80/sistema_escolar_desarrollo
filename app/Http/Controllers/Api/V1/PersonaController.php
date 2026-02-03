<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Http\Resources\PersonaResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'escuela_id' => ['required', 'exists:escuelas,id'],
        ]);

        $escuelaId = $request->input('escuela_id');

        /*$personas = Persona::with(['documentoTipo', 'legajos'])
                    ->withExists(['inscripcion as tiene_inscripcion_activa'])
                    ->get();  */
        $personas = Persona::with([
            'documentoTipo',
            'sexo', // Añadir si se necesita en el Resource
            'genero', // Añadir si se necesita en el Resource
            'nacionalidad',
            // Carga restringida de legajos:
            'legajos' => function ($query) use ($escuelaId) {
                $query->where('escuela_id', $escuelaId);
            }
        ])
        //->withExists(['inscripcion as tiene_inscripcion_activa'])
        ->withExists(['inscripcion as tiene_inscripcion_activa_en_escuela' => function ($query) use ($escuelaId) {

            // De Inscripcion a Espacio
            $query->whereHas('espacio', function ($q) use ($escuelaId) {

                // De Espacio a Propuesta
                $q->whereHas('propuesta', function ($qq) use ($escuelaId) {

                    // De Propuesta a la tabla pivot de Escuelas
                    $qq->whereHas('escuelas', function ($qqq) use ($escuelaId) {

                        // Aplica el filtro final
                        $qqq->where('escuela_id', $escuelaId);
                    });
                });
            });
        }])
        ->withExists(['historialInscripciones as tuvo_inscripcion_en_escuela' => function ($query) use ($escuelaId) {

            // De HistorialInscripcion a Espacio
            // El resto de la cadena de filtros sigue siendo necesaria para asegurar que fue en la escuela correcta
            $query->whereHas('espacio', function ($q) use ($escuelaId) {
                $q->whereHas('propuesta', function ($qq) use ($escuelaId) {
                    $qq->whereHas('escuelas', function ($qqq) use ($escuelaId) {
                        // Aquí, SoftDeletes de Propuesta/Pivot SÍ se mantienen,
                        // asegurando que el vínculo Propuesta-Escuela sigue siendo válido.
                        $qqq->where('escuela_id', $escuelaId);
                    });
                });
            });
        }])

        // Ordenamiento (Demostrado que funciona):
        ->orderBy('personas.apellido', 'asc')
        ->orderBy('personas.nombre', 'asc')

        // Select (Buena práctica):
        //->select('personas.*')
        ->get();

        $personasColeccion = PersonaResource::collection($personas);

        // Serializa manualmente la colección de recursos con el flag JSON_UNESCAPED_UNICODE
        $jsonResponse = json_encode([
            'data' => [ 'personas' => $personasColeccion->toArray($request) ]
        ], JSON_UNESCAPED_UNICODE);

        // Retorna la respuesta ya serializada con el encabezado correcto
        return response($jsonResponse, 200)
            ->header('Content-Type', 'application/json; charset=utf-8');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        //
    }

    public function verificarDuplicados(Request $request)
    {
        $nom = trim($request->json('nombre', ''));
        $ape = trim($request->json('apellido', ''));
        $tip = $request->json('documento_tipo_id');
        $num = $request->json('documento_numero');
        $tra = trim($request->json('tramite', ''));
        $idAct = $request->json('id');

        // Inicializamos contenedores de resultados
        $resNombres = collect();
        $resDocumento = collect();
        $resTramite = collect();
        $resCompleto = collect();

        // 1. Coincidencia por Nombres y Apellidos
        if (!empty($nom) && !empty($ape)) {
            $resNombres = Persona::where('nombre', $nom)->where('apellido', $ape)
                ->when($idAct, fn($q) => $q->where('id', '!=', $idAct))->get();
        }
        // 2. Coincidencia por Tipo y Número de Documento
        if (!empty($tip) && !empty($num)) {
            $resDocumento = Persona::where('documento_tipo_id', $tip)->where('documento_numero', $num)
                ->when($idAct, fn($q) => $q->where('id', '!=', $idAct))->get();
        }

        // 3. Coincidencia por Número de Trámite (Caso 4)
        if (!empty($tra)) {
            $resTramite = Persona::where('tramite', $tra)
                ->when($idAct, fn($q) => $q->where('id', '!=', $idAct))->get();
        }

        // 4. Coincidencia Completa (Caso 3: Nombre + Documento)
        if (!empty($nom) && !empty($ape) && !empty($tip) && !empty($num)) {
            $resCompleto = $resDocumento->filter(function($p) use ($nom, $ape) {
                return strcasecmp($p->nombre, $nom) == 0 && strcasecmp($p->apellido, $ape) == 0;
            });
        }
        // 5. Definición de Estados Individuales
        $detalles = [
            'nombres' => [
                'estado' => $resNombres->isNotEmpty() ? 'WARN' : 'OK',
                'mensaje' => $resNombres->isNotEmpty() ? 'Existen personas con el mismo nombre.' : 'Sin coincidencias.',
                'data' => $resNombres
            ],
            'documento' => [
                'estado' => $resDocumento->isNotEmpty() ? 'WARN' : 'OK',
                'mensaje' => $resDocumento->isNotEmpty() ? 'El número de documento ya existe.' : 'Documento disponible.',
                'data' => $resDocumento
            ],
            'tramite' => [
                'estado' => $resTramite->isNotEmpty() ? 'ERROR' : 'OK',
                'mensaje' => $resTramite->isNotEmpty() ? 'El número de trámite ya está registrado.' : 'Trámite válido.',
                'data' => $resTramite
            ],
            'identidad_total' => [
                'estado' => $resCompleto->isNotEmpty() ? 'ERROR' : 'OK',
                'mensaje' => $resCompleto->isNotEmpty() ? 'Esta persona ya está en la base de datos.' : 'Nueva identidad.',
                'data' => $resCompleto
            ]
        ];

        // 6. Estado Global para facilitar el bloqueo en VBA
        $permitirCarga = ($detalles['tramite']['estado'] !== 'ERROR' && $detalles['identidad_total']['estado'] !== 'ERROR');
        $tipoAlertaGlobal = "NONE";
        if (!$permitirCarga) {
            $tipoAlertaGlobal = "ERROR";
        } elseif (
                    $detalles['nombres']['estado'] === 'WARN' ||
                    $detalles['documento']['estado'] === 'WARN'
            ) {
            $tipoAlertaGlobal = "WARN";
        }

        return response()->json([
            'status' => 'success',
            'query_data' => $request->only(['nombre', 'apellido', 'documento_tipo_id', 'documento_numero', 'tramite','id']),
            'permitir_carga' => $permitirCarga,
            'alerta_global' => $tipoAlertaGlobal,
            'detalles' => $detalles
        ], 200);
    }

   /* public function verificarDuplicados(Request $request)
    {
        // Datos de entrada
        $nom = trim($request->json('nombre', ''));
        $ape = trim($request->json('apellido', ''));
        $tip = $request->json('documento_tipo_id');
        $num = $request->json('documento_numero');
        $tra = trim($request->json('tramite', ''));
        $idAct = $request->json('id'); // Para ignorar el registro actual si es edición

        $query = Persona::query()->with(['documentoTipo']);

        // 1. Buscamos coincidencias en la BD
        $resultados = $query->where(function($q) use ($nom, $ape, $tip, $num, $tra) {
            // Caso 4: Trámite (si viene)
            if (!empty($tra)) $q->orWhere('tramite', $tra);

            // Caso 2: Documento
            if (!empty($tip) && !empty($num)) {
                $q->orWhere(function($sub) use ($tip, $num) {
                    $sub->where('documento_tipo_id', $tip)->where('documento_numero', $num);
                });
            }

            // Caso 1: Nombres y Apellidos
            if (!empty($nom) && !empty($ape)) {
                $q->orWhere(function($sub) use ($nom, $ape) {
                    $sub->where('nombre', $nom)->where('apellido', $ape);
                });
            }
        })
        ->when($idAct, fn($q, $id) => $q->where('id', '!=', $id))
        ->get();

        $permitirCarga = true;
        $tipoAlerta = "NONE"; // NONE, WARN, ERROR
        $mensaje = "";

        foreach ($resultados as $p) {
            $mismoDoc = ($p->documento_tipo_id == $tip && $p->documento_numero == $num);
            $mismoNom = (strcasecmp($p->nombre, $nom) == 0 && strcasecmp($p->apellido, $ape) == 0);
            $mismoTra = (!empty($tra) && $p->tramite == $tra);

            // CASO 4 o CASO 3: Bloqueo (Error)
            if ($mismoTra || ($mismoDoc && $mismoNom)) {
                $permitirCarga = false;
                $tipoAlerta = "ERROR";
                $mensaje = $mismoTra ? "Error: Número de trámite duplicado." : "Error: La persona ya existe (DNI y Nombre coinciden).";
                break;
            }

            // CASO 1 o CASO 2: Advertencia (Warning)
            if ($mismoNom || $mismoDoc) {
                $tipoAlerta = "WARN";
                $mensaje = "Atención: Se encontraron coincidencias parciales.";
            }
        }

        return response()->json([
            'permitir_carga' => $permitirCarga,
            'query_data'     => $queryData,
            'tipo_alerta'    => $tipoAlerta,
            'mensaje'        => $mensaje,
            'count'          => $resultados->count(),
            'results'        => $resultados
        ], 200);
    }*/

    /*public function verificarDuplicados(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|min:2', // Minimo 2 letras para no saturar
            'apellido' => 'required|string|min:2',
            'id'        => 'nullable'
        ]);

        $nombreInput = preg_replace('/\s+/', ' ', trim($request->json('nombre')));
        $apellidoInput = preg_replace('/\s+/', ' ', trim($request->json('apellido')));
        $idActual      = $request->json('id');

        $duplicados = Persona::query()
            ->with(['documentoTipo'])
            // Usamos LIKE con comodines % al inicio y al final
            ->where('nombre', 'LIKE', "{$nombreInput}%")
            ->where('apellido', 'LIKE', "%{$apellidoInput}%")
            ->when($idActual, function ($query, $idActual) {
                return $query->where('id', '!=', $idActual);
            })
            // Limitamos a 10 para no colgar el Excel si hay muchos nombres comunes
            ->limit(10)
            ->get(['id', 'nombre', 'apellido', 'documento_numero', 'documento_tipo_id']);
        $res = $duplicados->map(function ($p) {
            return [
                'id'               => $p->id,
                'nombre'           => $p->nombre,
                'apellido'         => $p->apellido,
                'documento_numero' => $p->documento_numero,
                'documento_tipo'   => $p->documentoTipo ? $p->documentoTipo->nombre : 'Sin Tipo',
            ];
        });

        return response()->json([
            'status'  => 'success',
            'found'   => $res->isNotEmpty(),
            'count'   => $res->count(),
            'results' => $res
        ], 200);
    }*/

}

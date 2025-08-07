<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuarioEscuela;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class SolicitarColegio extends Controller
{
    public function solicitarColegio(Request $request): JsonResponse {
    
        $request->validate([
            'id_escuela' => ['required', 'exists:escuela,id'] // Se agregó 'exists' para mayor seguridad
        ]);

        $user = $request->user();

        $ue = UsuarioEscuela::firstOrCreate(
            [
                'id_usuario' => $user->id,
                'id_escuela' => $request->id_escuela
            ],
            [
                'verified_at' => null,
                'id_usario_tipo' => 5
            ]
        );

        if (! $ue->wasRecentlyCreated) {
            return response()->json([
                'message' => 'El usuario ya tiene solicitado ese colegio.'
            ], Response::HTTP_CONFLICT);
        }

        // Cargamos las relaciones en la instancia de usuario existente.
        $user->load(['usuarioEscuelas.usuarioTipo']);

        return response()->json($user, Response::HTTP_CREATED);  
        
    }

    public function refreshColegios(Request $request) {

    // Obtener el usuario autenticado directamente desde la solicitud.
        $user = $request->user();

        // Si el usuario no existe (aunque es improbable en una ruta protegida),
        // puedes retornar un error.
        if (!$user) {
            return response()->json(['message' => 'Usuario no autenticado.'], 401);
        }

        // Cargar las relaciones directamente sobre el objeto de usuario.
        $user->load([
            'usuarioEscuelas.escuela',
            'usuarioEscuelas.usuarioTipo'
        ]);

        // Retornar la respuesta JSON.
        return response()->json($user, Response::HTTP_OK);
    }
}

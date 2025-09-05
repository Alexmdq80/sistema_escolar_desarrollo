<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\EscuelaUsuario;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class SolicitarColegio extends Controller
{
    public function solicitarColegio(Request $request): JsonResponse {

        $request->validate([
            'id_escuela' => ['required', 'exists:escuela,id'] // Se agregó 'exists' para mayor seguridad
        ]);

        $usuario = $request->user();

        $ue = EscuelaUsuario::firstOrCreate(
            [
                'usuario_id' => $usuario->id,
                'escuela_id' => $request->id_escuela
            ],
            [
                'verified_at' => null,
                'usario_tipo_id' => 5
            ]
        );

        if (! $ue->wasRecentlyCreated) {
            return response()->json([
                'message' => 'El usuario ya tiene solicitado ese colegio.'
            ], Response::HTTP_CONFLICT);
        }

        // Cargamos las relaciones en la instancia de usuario existente.
        $usuario->load([
            'escuelaUsuarios.escuela',
            'escuelaUsuarios.usuarioTipo'
        ]);

        return response()->json($usuario, Response::HTTP_CREATED);

    }

}

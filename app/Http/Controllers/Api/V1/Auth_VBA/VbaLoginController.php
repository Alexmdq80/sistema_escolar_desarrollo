<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario_Escuela;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @group Auth_VBA
 */
class VbaLoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'id_escuela' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['El usuario y/o la contraseña no son válidas.'],
            ]);
        }

        $ue = Usuario_Escuela::where('id_usuario', $user->id)
                            ->where('id_escuela', $request->id_escuela)
                            ->with('UsuarioTipo')
                            ->first();

        if (!$ue) {
            throw ValidationException::withMessages([
                'usuario_escuela' => ['El usuario no tiene permisos para ese colegio.'],
            ]);
        }

        if (!$ue->verificado) {
            throw ValidationException::withMessages([
                'usuario_escuela' => ['El usuario no está verificado.'],
            ]);
        }


        $device    = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->remember ? null : now()->addMinutes(60);

        return response()->json([
           'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
           'usuario' => $user,
           'usuario_escuela' => $ue
        ], Response::HTTP_CREATED);

     //   return response()->json($user);
    }

}

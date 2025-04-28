<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * @group Auth_VBA
 */
class VbaPerfilController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user()->only('name', 'email'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('usuario')->ignore(auth()->user())],
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user(); // El usuario autenticado a través del token

    // Verificar la contraseña actual
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        if ($user->email <> $validatedData['email']) {
        /* habría que chequear si modificó el email, en ese caso
        eliminar los timestamps de verificación del email */
            $user->email_verified_at = null;
        }

        $user->email = $validatedData['email'];
        $user->nombre = $validatedData['nombre'];
        $user->apellido = $validatedData['apellido'];
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        $responseData = [
            'email' => $validatedData['email'],
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
        ];

        return response()->json($responseData, Response::HTTP_ACCEPTED);

      //  return response()->json($validatedData, Response::HTTP_ACCEPTED);
      //  return response()->json(['message' => 'Perfil actualizado correctamente'], Response::HTTP_OK);  return response()->json($validatedData, Response::HTTP_ACCEPTED);
    }

   /* public function obtenerUsuario(string $email): JsonResponse */
/*        $usuario = User::where('email', $email)
                        ->with('usuarioEscuelas')
                        ->with('usuarioEscuelas.usuarioTipo')
                        ->first();

        if ($usuario) {
            return response()->json($usuario);
        } else {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        } */

   public function obtenerUsuario(Request $request): JsonResponse
   {

        $user = $request->user(); // El usuario autenticado a través del token

       /* $usuario = User::where(['email', $user->email],
                               ['usuarioEscuela.id_escuela', $request->id_escuela])
        ->with('usuarioEscuelas')
        ->with('usuarioEscuelas.usuarioTipo')
        ->first();*/
        $usuario = User::where('email', $user->email)
                        ->whereHas('usuarioEscuelas', function ($query) use ($request) {
                            $query->where('id_escuela', $request->id_escuela);
                        })
                        ->with('usuarioEscuelas')
                        ->with('usuarioEscuelas.usuarioTipo')
                        ->first();

        if ($usuario) {
            return response()->json($usuario, 200);
        } else {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
    }

    public function checkUser(string $email): JsonResponse
    {
        $usuario = User::where('email', $email)->first();

        if ($usuario) {
            return response()->json(['mensaje' => 'Usuario encontrado'], 200);
        } else {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
    }
}

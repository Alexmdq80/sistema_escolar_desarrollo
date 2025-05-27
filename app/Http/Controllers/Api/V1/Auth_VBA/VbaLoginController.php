<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario_Escuela;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\RefreshToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
/**
 * @group Auth_VBA
 */
class VbaLoginController extends Controller
{
    public function __invoke(Request $request)
    {
     //   Log::info('User-Agent recibido en login: ' . $request->header('User-Agent'));

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
         //   'id_escuela' => ['required']
        ]);

      /*  $user = User::where('email', $request->email)
                      ->with('usuarioEscuelas')
                      ->with('UsuarioTipo')
                      ->first()*/

        $user = User::where('email', $request->email)
             ->with(['usuarioEscuelas.usuarioTipo']) // Carga anidada aquí
             ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['El usuario y/o la contraseña no son válidas.'],
            ]);
        }

        //$ue = Usuario_Escuela::where('id_usuario', $user->id)
        //                    ->where('id_escuela', $request->id_escuela)
        //                    ->with('UsuarioTipo')
        //                    ->first();

        //if (!$ue) {
        //    throw ValidationException::withMessages([
        //        'usuario_escuela' => ['El usuario no tiene permisos para ese colegio.'],
        //    ]);
        //}

        //if (!$ue->verificado) {
        //    throw ValidationException::withMessages([
        //        'usuario_escuela' => ['El usuario no está verificado.'],
        //    ]);
        //}


        $device    = substr($request->userAgent() ?? '', 0, 255);
        $expiresAt = $request->remember ? null : now()->addMinutes(180);

        // Eliminar todos los tokens existentes del usuario
        // $user->tokens()->delete();
        $user->tokens()->where('name', $device)->delete();

        // Eliminar cualquier refresh token existente para este usuario y dispositivo
        RefreshToken::where('id_usuario', $user->id)
            ->where('device_id', $device)
            ->delete();

        $refreshToken = Str::random(80); // Generar un string aleatorio para el refresh token
        $refreshTokenExpiresAt = now()->addMinutes(config('sanctum.refresh_expiration', 20160));
      //  $device_id = substr($request->userAgent() ?? '', 0, 255); // Obtener el device_id

      //  Log::info('User-Agent useragent(): ' . $device  );
      //  Log::info('User-Agent useragent(): ' . $device_id  );

        RefreshToken::create([
            'id_usuario' => $user->id,
            'token' => hash('sha256', $refreshToken),
            'expires_at' => $refreshTokenExpiresAt,
            'device_id' => $device,
        ]);

        return response()->json([
           'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
           'refresh_token' => $refreshToken,
           'usuario' => $user
        //   'usuario_escuela' => $ue
        ], Response::HTTP_CREATED);

     //   return response()->json($user);
    }

}

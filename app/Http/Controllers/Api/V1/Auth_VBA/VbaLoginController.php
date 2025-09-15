<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\RefreshToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Response;

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
        ]);

     //   $user = User::where('email', $request->email)->first();
        // la consulta ya devuelve todos los colegios que tenga el usuario
        // y qué tipo de usuario es en cada uno de ellos
        $usuario = Usuario::where('email', $request->email)
            ->with([
                    'escuelaUsuarios.escuela',
                    'escuelaUsuarios.usuarioTipo'])
            ->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            // Disparar el evento Failed.
            // El Listener LogFailedLoginAttempt ya está preparado para manejar 'null' o el objeto User
            event(new Failed('sanctum',  $usuario, $request->only('email')));
            throw ValidationException::withMessages([
                'email' => ['El usuario y/o la contraseña no son válidas.'],
            ]);
        }

        $device    = substr($request->userAgent() ?? '', 0, 255);
        // corregir acá, puse 1 para probar, cambiar a 240
        $expiresAt = $request->remember ? null : now()->addMinutes(240);

        // Eliminar todos los tokens existentes del usuario en el dispositivo actual
        $usuario->tokens()->where('name', $device)->delete();

        // Eliminar cualquier refresh token existente para este usuario y dispositivo
        RefreshToken::where('usuario_id', $usuario->id)
            ->where('device_id', $device)
            ->delete();

        $refreshToken = Str::random(80); // Generar un string aleatorio para el refresh token
        $refreshTokenExpiresAt = now()->addMinutes(config('sanctum.refresh_expiration', 20160));

        RefreshToken::create([
            'usuario_id' => $usuario->id,
            'token' => hash('sha256', $refreshToken),
            'expires_at' => $refreshTokenExpiresAt,
            'device_id' => $device,
        ]);

        event(new Login('sanctum', $usuario, false));

        /*return response()->json([
           'access_token' => $usuario->createToken($device, expiresAt: $expiresAt)->plainTextToken,
           'refresh_token' => $refreshToken,
           'usuario' => $usuario
        ], Response::HTTP_CREATED);*/
       /* Log::info('Datos del usuario a serializar', $usuario->toArray());
        return response()->json([
            'access_token' => $usuario->createToken($device, expiresAt: $expiresAt)->plainTextToken,
            'refresh_token' => $refreshToken,
            'usuario' => $usuario
        ], Response::HTTP_CREATED, [], JSON_UNESCAPED_UNICODE);*/
// ...

    $usuarioData = $usuario->toArray();

    // Registra la información en el log (para verificación)
   // Log::info('Datos del usuario a serializar', $usuarioData);

    // Serializa manualmente el array a JSON con el flag
    $jsonResponse = json_encode([
        'access_token' => $usuario->createToken($device, expiresAt: $expiresAt)->plainTextToken,
        'refresh_token' => $refreshToken,
        'usuario' => $usuarioData
    ], JSON_UNESCAPED_UNICODE);

    // Si hubo un error en la serialización, loguéalo
    if (json_last_error() !== JSON_ERROR_NONE) {
        Log::error('Error de serialización JSON: ' . json_last_error_msg());
    }

    // Devuelve la respuesta con el JSON ya serializado y el encabezado correcto
    return response($jsonResponse, Response::HTTP_CREATED)
        ->header('Content-Type', 'application/json; charset=utf-8');

    }

    public function refreshToken(Request $request)
    {
        // El token de refresco debería venir en el encabezado Authorization como un Bearer token.
        $refreshTokenString = str_replace('Bearer ', '', $request->header('Authorization'));

        if (!$refreshTokenString) {
            return response()->json(['message' => 'Refresh token no proporcionado.'], 401);
        }

        // HASHEA el token recibido para poder buscarlo en la base de datos
        // donde está guardado como un hash.
        $hashedReceivedToken = hash('sha256', $refreshTokenString);

        // Ahora busca en tu tabla personalizada 'RefreshTokens'
        // NOTA: Asegúrate de que 'expires_at' se almacene como un tipo de fecha y hora
        // para que `isPast()` funcione correctamente.
        $refreshTokenRecord = RefreshToken::where('token', $hashedReceivedToken)
                                          ->where('expires_at', '>', now()) // Asegura que no esté expirado
                                          ->first();

        // Buscar el PersonalAccessToken asociado al refresh token
        // Sanctum almacena todos los tokens en la tabla personal_access_tokens
        //$refreshTokenRecord = \Laravel\Sanctum\PersonalAccessToken::findToken($refreshTokenString);

        // Verificar si el token existe y está asociado a un usuario
        //if (!$refreshTokenRecord || !$refreshTokenRecord->tokenable) {
        //    return response()->json(['message' => 'Refresh token inválido.'], 401);
        //}
        // Verificar si el token existe y está asociado a un usuario
        if (!$refreshTokenRecord || !$refreshTokenRecord->user) { // Usa usuario_id para verificar la relación
            return response()->json(['message' => 'Refresh token inválido.'], 401);
        }

         // Obtener el usuario asociado al token de refresco
        $usuario = Usuario::find($refreshTokenRecord->usuario_id); // Busca el usuario por usuario_id

        if (!$usuario) {
             return response()->json(['message' => 'Usuario no encontrado para el refresh token.'], 401);
        }


        // Revocar el refresh token actual (esto es importante para el "one-time use")
        $refreshTokenRecord->delete(); // Elimina el registro de la DB

        // Obtener la duración del nuevo token de acceso y de refresco
        $newAccessTokenExpiration = config('sanctum.expiration');
        $newRefreshTokenExpiration = config('sanctum.refresh_expiration');

        // Generar un **nuevo Access Token** usando Sanctum
        // El 'name' aquí podría ser el device_id o cualquier identificador único que tengas
        $newAccessToken = $usuario->createToken(
            $refreshTokenRecord->device_id ?? 'default_device', // Usa el device_id guardado o un default
            ['*'],
            now()->addMinutes($newAccessTokenExpiration)
        )->plainTextToken;

        // Generar un **nuevo Refresh Token**
        $newRefreshToken = Str::random(80); // Genera el nuevo string aleatorio
        $hashedNewRefreshToken = hash('sha256', $newRefreshToken); // Hashea el nuevo token para guardarlo

        // Guardar el nuevo refresh token hasheado en tu tabla personalizada
        RefreshToken::create([
            'usuario_id' => $usuario->id,
            'token' => $hashedNewRefreshToken,
            'expires_at' => now()->addMinutes($newRefreshTokenExpiration),
            'device_id' => $refreshTokenRecord->device_id ?? 'default_device',
        ]);

        return response()->json([
            'access_token' => $newAccessToken,
            'token_type' => 'Bearer',
            'refresh_token' => $newRefreshToken, // Envía el token sin hashear al cliente (VBA)
            'access_token_expires_in' => $newAccessTokenExpiration * 60,
            'refresh_token_expires_in' => $newRefreshTokenExpiration * 60,
        ]);


        // Obtener el usuario asociado al token de refresco
        //$user = $refreshTokenRecord->tokenable;

        // Validar si el token tiene la habilidad 'refresh' y si no ha expirado
        // Es crucial que el refresh token no esté expirado por su propia configuración
       // if (!$refreshTokenRecord->can('refresh') || $refreshTokenRecord->expires_at->isPast()) {
            // Si el refresh token es inválido o ha expirado, lo revocamos y forzamos re-login
        //    $refreshTokenRecord->delete(); // Elimina el token expirado/inválido de la DB
       //     return response()->json(['message' => 'Refresh token inválido o expirado. Por favor, inicie sesión de nuevo.'], 401);
       // }

        // //**Estrategia de Revocación de Refresh Token (Muy Recomendada):**
        // Para mayor seguridad, revocamos el token de refresco actual después de usarlo.
        // Esto implementa un flujo de "un solo uso" para los refresh tokens.
       // $refreshTokenRecord->delete();

        // Obtener la duración del nuevo token de acceso y de refresco
       // $newAccessTokenExpiration = config('sanctum.expiration');
      //  $newRefreshTokenExpiration = config('sanctum.refresh_expiration');

        // Generar un **nuevo Access Token**
       ////* $newAccessToken = $user->createToken(
        /*    $refreshTokenRecord->name, // Reutiliza el nombre del dispositivo original
            ['*'],
            now()->addMinutes($newAccessTokenExpiration)
        )->plainTextToken;

        // Generar un **nuevo Refresh Token**
        $newRefreshToken = $user->createToken(
            'refresh_token', // Nombre para el nuevo refresh token
            ['refresh'],
            now()->addMinutes($newRefreshTokenExpiration)
        )->plainTextToken;

        return response()->json([
            'access_token' => $newAccessToken,
            'token_type' => 'Bearer',
            'refresh_token' => $newRefreshToken,
            'access_token_expires_in' => $newAccessTokenExpiration * 60,
            'refresh_token_expires_in' => $newRefreshTokenExpiration * 60,
        ]);/*//*
        */
    }

}

<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\RefreshToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;

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

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Disparar el evento Failed.
            // El Listener LogFailedLoginAttempt ya está preparado para manejar 'null' o el objeto User
            event(new Failed('sanctum',  $user, $request->only('email')));
            throw ValidationException::withMessages([
                'email' => ['El usuario y/o la contraseña no son válidas.'],
            ]);
        }

        $device    = substr($request->userAgent() ?? '', 0, 255);
        // corregir acá, puse 1 para probar, cambiar a 240
        $expiresAt = $request->remember ? null : now()->addMinutes(240);

        // Eliminar todos los tokens existentes del usuario
        $user->tokens()->where('name', $device)->delete();

        // Eliminar cualquier refresh token existente para este usuario y dispositivo
        RefreshToken::where('id_usuario', $user->id)
            ->where('device_id', $device)
            ->delete();

        $refreshToken = Str::random(80); // Generar un string aleatorio para el refresh token
        $refreshTokenExpiresAt = now()->addMinutes(config('sanctum.refresh_expiration', 20160));

        RefreshToken::create([
            'id_usuario' => $user->id,
            'token' => hash('sha256', $refreshToken),
            'expires_at' => $refreshTokenExpiresAt,
            'device_id' => $device,
        ]);

        event(new Login('sanctum', $user, false));

        return response()->json([
           'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
           'refresh_token' => $refreshToken,
           'usuario' => $user
        ], Response::HTTP_CREATED);

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
        if (!$refreshTokenRecord || !$refreshTokenRecord->user) { // Usa id_usuario para verificar la relación
            return response()->json(['message' => 'Refresh token inválido.'], 401);
        }

         // Obtener el usuario asociado al token de refresco
        $user = User::find($refreshTokenRecord->id_usuario); // Busca el usuario por id_usuario

        if (!$user) {
             return response()->json(['message' => 'Usuario no encontrado para el refresh token.'], 401);
        }


        // Revocar el refresh token actual (esto es importante para el "one-time use")
        $refreshTokenRecord->delete(); // Elimina el registro de la DB

        // Obtener la duración del nuevo token de acceso y de refresco
        $newAccessTokenExpiration = config('sanctum.expiration');
        $newRefreshTokenExpiration = config('sanctum.refresh_expiration');

        // Generar un **nuevo Access Token** usando Sanctum
        // El 'name' aquí podría ser el device_id o cualquier identificador único que tengas
        $newAccessToken = $user->createToken(
            $refreshTokenRecord->device_id ?? 'default_device', // Usa el device_id guardado o un default
            ['*'],
            now()->addMinutes($newAccessTokenExpiration)
        )->plainTextToken;

        // Generar un **nuevo Refresh Token**
        $newRefreshToken = Str::random(80); // Genera el nuevo string aleatorio
        $hashedNewRefreshToken = hash('sha256', $newRefreshToken); // Hashea el nuevo token para guardarlo

        // Guardar el nuevo refresh token hasheado en tu tabla personalizada
        RefreshToken::create([
            'id_usuario' => $user->id,
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

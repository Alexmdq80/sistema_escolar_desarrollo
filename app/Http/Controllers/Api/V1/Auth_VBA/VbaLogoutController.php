<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * @group Auth_VBA
 */
class VbaLogoutController extends Controller
{
    public function logout(Request $request)
    {

       // Log::info('User-Agent recibido en login: ' . $request->header('User-Agent'));

        $request->user()->currentAccessToken()->delete();
        $deviceId = substr($request->userAgent() ?? '', 0, 255);
          // Eliminar el refresh token asociado al usuario
      //   \App\Models\RefreshToken::where('id_usuario', $request->user()->id)->delete();

       \App\Models\RefreshToken::where('id_usuario', $request->user()->id)
              ->where('device_id', $deviceId)
              ->delete();

      /*  return response()->noContent();*/

        return response()->json(['resultado' => 'logout del dispositivo exitoso'], 200);

    }
 /*   public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->noContent();
        } catch (\Exception $e) {
            \Log::error('Error al realizar el logout de VBA: ' . $e->getMessage());
            return response()->json(['message' => 'Error al cerrar sesión'], 500);
        }
    } */
}

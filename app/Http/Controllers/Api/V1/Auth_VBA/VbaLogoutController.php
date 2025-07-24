<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\RefreshToken;
use Illuminate\Auth\Events\Logout;
/**
 * @group Auth_VBA
 */
class VbaLogoutController extends Controller
{
    public function logout(Request $request)
    {

       // Log::info('User-Agent recibido en login: ' . $request->header('User-Agent'));
        try {
            event(new Logout('sanctum', $request->user()));
            $request->user()->currentAccessToken()->delete();
            $deviceId = substr($request->userAgent() ?? '', 0, 255);
            // Eliminar el refresh token asociado al usuario
            RefreshToken::where('id_usuario', $request->user()->id)
                ->where('device_id', $deviceId)
                ->delete();
            return response()->json(['message' => 'logout del dispositivo exitoso'], 200);
        } catch (\Exception $e) {
            \Log::error('Error al realizar el logout de VBA: ' . $e->getMessage(), ['user_id' => $request->user()->id ?? 'N/A']);
            return response()->json(['message' => 'Error al intentar cerrar sesión', 'error' => $e->getMessage()], 500);
        }

    }
}

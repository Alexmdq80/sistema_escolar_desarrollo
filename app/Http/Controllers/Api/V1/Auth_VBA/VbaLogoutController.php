<?php

namespace App\Http\Controllers\Api\V1\Auth_VBA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Auth_VBA
 */
class VbaLogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

      /*  return response()->noContent();*/

        return response()->json([
            'resultado' => 'logout correcto',
            ], 200);

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

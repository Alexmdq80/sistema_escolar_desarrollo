<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegistroController;
use App\Http\Controllers\Api\V1\Auth\PerfilController;
use App\Http\Controllers\Api\V1\PersonaController;
use App\Http\Controllers\Api\V1\InscripcionController;
/*

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

  

// Route::get('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);

// Route::get('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('personas', PersonaController::class);
    // Route::apiResource('inscripciones', InscripcionController::class);

    // Route::apiResource('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);
 
    Route::get('perfil', [PerfilController::class, 'show']);
    Route::put('perfil', [PerfilController::class, 'update']);
    Route::post('auth/logout', LogoutController::class);
  
    // Route::post('alquileres/inicio', [AlquilerController::class, 'inicio']);
    // Route::put('alquileres/finalizar/{alquiler}', [AlquilerController::class, 'finalizar']);
    // Route::get('alquileres', [AlquilerController::class, 'index']);

    // Rutas que no requieren el middleware "es_admin"

    // // Rutas que requieren el middleware "es_admin"
    // Route::apiResource('bicicletas', BicicletaController::class)->except(['index', 'show'])->middleware('es_admin');
});


Route::post('auth/registro', RegistroController::class)->name('registro');
Route::post('auth/login', LoginController::class)->name('login');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegistroController;
use App\Http\Controllers\Api\V1\Auth\PerfilController;
use App\Http\Controllers\Api\V1\PersonaController;
use App\Http\Controllers\Api\V1\InscripcionController;
// use Illuminate\Validation\ValidationException;
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
// Route::apiResource('inscripciones/show-by-espacio', [InscripcionController::class,'showByEspacio']);


/* Route::post('/test-error', function () {
    throw ValidationException::withMessages([
        'test' => ['Este es un error de prueba.'],
    ]);
});*/

Route::get('/inscripciones/{id}', [InscripcionController::class, 'obtenerInscripcion']);
Route::post('auth/login', LoginController::class)->name('login');



Route::middleware('auth:sanctum')->group(function () {

   Route::apiResource('inscripciones', InscripcionController::class);
    // Route::apiResource('inscripciones/showByEspacio/{id}', [InscripcionController::class, 'showByEspacio']);
    Route::apiResource('personas', PersonaController::class);

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


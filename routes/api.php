<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AngularLoginController;
use App\Http\Controllers\Api\V1\Auth\AngularLogoutController;
use App\Http\Controllers\Api\V1\Auth\AngularRegistroController;
use App\Http\Controllers\Api\V1\Auth\AngularPerfilController;

use App\Http\Controllers\Api\V1\PersonaController;
use App\Http\Controllers\Api\V1\InscripcionController;
use App\Http\Controllers\Api\V1\InscripcionController_VBA;
use App\Http\Controllers\Api\V1\HealthCheckController;

use App\Http\Controllers\Api\V1\Auth_VBA\VbaLoginController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaLogoutController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaRegistroController;
use App\Http\Controllers\Api\V1\Auth_VBA\VbaPerfilController;
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

Route::get('/health', [HealthCheckController::class, 'check']);

Route::middleware('auth:sanctum')->group(function () {

   Route::group(['prefix' => 'vba'], function () {
       Route::get('inscripciones/{id}', [InscripcionController_VBA::class, 'obtenerInscripcion']);
   });

   Route::group(['prefix' => 'angular'], function () {
       Route::apiResource('inscripciones', InscripcionController::class);
       Route::apiResource('personas', PersonaController::class);
   });


   Route::group(['prefix' => 'auth-Angular'], function () {
        Route::get('perfil', [AngularPerfilController::class, 'show']);
        Route::put('perfil', [AngularPerfilController::class, 'update']);
        Route::post('logout', AngularLogoutController::class);
   });

   Route::group(['prefix' => 'auth-VBA'], function () {
        Route::put('vbaPerfil', [VbaPerfilController::class, 'update']);
        Route::get('usuario_actual/{id_escuela}', [VbaPerfilController::class, 'obtenerUsuario']);
        Route::post('logout', [VbaLogoutController::class, 'logout']);
   });



});



Route::group(['prefix' => 'auth'], function () {
    Route::post('auth/login', AngularLoginController::class)->name('login');
    Route::post('auth/registro', AngularRegistroController::class)->name('registro');
});

Route::group(['prefix' => 'auth-VBA'], function () {
    Route::post('vbaLogin', VbaLoginController::class)->name('vbaLogin');
    Route::post('vbaRegistro', VbaRegistroController::class)->name('vbaRegistro');
    Route::get('/check-user/{email}', [VbaPerfilController::class, 'checkUser']);
});

 // Route::post('alquileres/inicio', [AlquilerController::class, 'inicio']);
    // Route::put('alquileres/finalizar/{alquiler}', [AlquilerController::class, 'finalizar']);
    // Route::get('alquileres', [AlquilerController::class, 'index']);

    // Rutas que no requieren el middleware "es_admin"

    // // Rutas que requieren el middleware "es_admin"
    // Route::apiResource('bicicletas', BicicletaController::class)->except(['index', 'show'])->middleware('es_admin');


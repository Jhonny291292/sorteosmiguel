<?php

use App\Http\Controllers\EmergenciasController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\organismosController;
use App\Http\Controllers\frenteController;
use App\Http\Controllers\municipiosController;
use App\Http\Controllers\parroquiasController;
use App\Http\Controllers\estructurasController;





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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/emergencias', EmergenciasController::class);
Route::apiResource('/organismos', organismosController::class);
Route::apiResource('/frentes', frenteController::class);
Route::apiResource('/municipios', municipiosController::class);
Route::apiResource('/parroquias', parroquiasController::class);
Route::apiResource('/estructuras', estructurasController::class);
Route::apiResource('/user', UserController::class);
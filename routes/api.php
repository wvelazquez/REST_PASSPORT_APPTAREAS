<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\tareaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('tarea',tareaController::class)->middleware('auth:api');
//Rutas de logueo
Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/loguin', [AuthController::class, 'loguin']);
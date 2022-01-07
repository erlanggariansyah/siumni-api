<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AlumniController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::get('/news', [NewsController::class, 'read']);
    Route::post('/news', [NewsController::class, 'create']);
    Route::put('/news/{id}', [NewsController::class, 'update']);
    Route::delete('/news/{id}', [NewsController::class, 'delete']);
    Route::get('/news/{id}', [NewsController::class, 'getById']);

    Route::get('/alumni', [AlumniController::class, 'read']);
    Route::post('/alumni', [AlumniController::class, 'create']);
    Route::put('/alumni/{id}', [AlumniController::class, 'update']);
    Route::delete('/alumni/{id}', [AlumniController::class, 'delete']);
    Route::get('/alumni/{id}', [AlumniController::class, 'getById']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;

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

// User API
Route::post('/user/create', [UserController::class, 'create']);
Route::get('/user/{id}', [UserController::class, 'readByID']);
Route::get('/users', [UserController::class, 'read']);
Route::put('/user/{id}/update', [UserController::class, 'update']);
Route::delete('/user/{id}/delete', [UserController::class, 'delete']);

// User Role API
Route::post('/user-role/create', [UserRoleController::class, 'create']);
Route::get('/user-role/{id}', [UserRoleController::class, 'readByID']);
Route::get('/user-roles', [UserRoleController::class, 'read']);
Route::put('/user-role/{id}/update', [UserRoleController::class, 'update']);
Route::delete('/user-role/{id}/delete', [UserRoleController::class, 'delete']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

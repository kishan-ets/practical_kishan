<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::group([
    'prefix' => 'v1',
    // 'namespace' => 'API',
], function () {

    Route::post('register', [UserController::class, 'register']);

    Route::post('login',[LoginController::class, 'login']);

    Route::post('forgot-passsword', [LoginController::class, 'forgotPassword']);

    Route::group([
        'middleware' => ['auth:api','check.permission'],
    ], function() {

        Route::post('add_role', [UserController::class, 'addRole']);

        Route::post('add_permission', [UserController::class, 'addPermission']);

        Route::post('add_role_permission', [UserController::class, 'addRolePermission']);

        Route::apiResource('users', 'App\Http\Controllers\UserController');

        Route::post('deletemultiple', [UserController::class, 'deleteAll']);

        Route::get('user-export', [UserController::class, 'export']);

        Route::post('change-password',[LoginController::class, 'changePassword']);

        Route::get('logout',[LoginController::class, 'logout']);

    });

});
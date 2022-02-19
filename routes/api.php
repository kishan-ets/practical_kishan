<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\CountriesController;
use App\Http\Controllers\API\StatesAPIController;
use App\Http\Controllers\API\CitiesAPIController;
use App\Http\Controllers\API\RolesAPIController;
use App\Http\Controllers\API\PermissionsAPIController;

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
        'middleware' => ['auth:api'],
    ], function() {

        // Route::post('add_role', [UserController::class, 'addRole']);

        // Route::post('add_permission', [UserController::class, 'addPermission']);

        Route::post('add_role_permission/{id}', [UserController::class, 'addRolePermission']);

        Route::apiResource('users', 'App\Http\Controllers\API\UserController');

        Route::post('deletemultiple', [UserController::class, 'deleteAll']);

        Route::post('users-import', [UserController::class, 'import']);

        Route::get('user-export', [UserController::class, 'export']);

        Route::post('change-password',[LoginController::class, 'changePassword']);

        Route::get('logout',[LoginController::class, 'logout']);



        //Countries
        Route::apiResource('countries', 'App\Http\Controllers\API\CountriesController');

        Route::post('deleteMultipleCountry', [CountriesController::class, 'deleteAll']);


        //State
        Route::apiResource('states', 'App\Http\Controllers\API\StatesAPIController');

        Route::post('deleteMultipleState', [StatesAPIController::class, 'deleteAll']);

        //City
        Route::apiResource('cities', 'App\Http\Controllers\API\CitiesAPIController');

        Route::post('deleteMultipleCity', [CitiesAPIController::class, 'deleteAll']);

        //Role
        Route::apiResource('roles', 'App\Http\Controllers\API\RolesAPIController');

        Route::post('deleteMultipleRole', [RolesAPIController::class, 'deleteAll']);

        //Role
        Route::apiResource('permissions', 'App\Http\Controllers\API\PermissionsAPIController');

        Route::post('deleteMultiplePermissions', [PermissionsAPIController::class, 'deleteAll']);

    });

});
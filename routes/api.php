<?php

use Illuminate\Http\Request;

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

Route::prefix('auth')->group(function () {
    // Below mention routes are public, user can access those without any restriction.
    // Create New User
    Route::post('register', 'AuthController@register');
    // Login User
    Route::post('login', 'AuthController@login');
    
    // Refresh the JWT Token
    Route::get('refresh', 'AuthController@refresh');
    
    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');
        // Agregar registro
        Route::post('registro/create', 'RegisterController@store');
        // Obtener registro
        Route::get('registro/index', 'RegisterController@index');
        // Agregar registro
        Route::post('registro/importar', 'RegisterController@importarDatos');
        // Agregar registro
        Route::get('registro/inforut', 'RegisterController@infoRut');
        // Logout user from application
        Route::post('logout', 'AuthController@logout');
    });
});


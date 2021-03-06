<?php

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

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::group([
    'middleware' => 'JWT',
    'namespace' => 'App\Http\Controllers\API',
], function ($router) {
    Route::post('make-link', 'MakeLinkController@index');
});

Route::group([
    'middleware' => 'JWT',
    'namespace' => 'App\Http\Controllers\API',
], function () {
    Route::apiResource('/links', 'LinkController')->only(['index', 'store']);;
});
